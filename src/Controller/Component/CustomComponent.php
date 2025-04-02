<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;

class CustomComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [];

    public function atualizacaoLaudo($limit = 10, $offset = 0, $search = null, $export = false)
    {
           // Loga a query final montada
           $this->log("Busca: " . $search);
        $conexaoRemota = ConnectionManager::get('remote_laudo');

        // Parte comum da query
        $whereClause = "WHERE e_laudopendente = 'Sim' AND e_servico = 'Remocao' AND tss_id <= '40'";
        $params = [];
        $searchParams = [];

        // Adiciona condição de busca se existir
        if (!empty($search)) {
            $whereClause .= " AND (e_tipoatendimento LIKE :search OR loc_description LIKE :search OR e_acoesnecessarias LIKE :search)";
            $searchParams['search'] = "%{$search}%";
        }

        // Query para os dados
        $dataQuery = "SELECT loc_datetimeinsert, e_tipoatendimento, loc_id, loc_description, e_bairro, tsk_situation, e_acoesnecessarias 
                    FROM looker_laudopendente 
                    {$whereClause}
                    ORDER BY loc_datetimeinsert";

        // Query para contar o total de registros
        $countQuery = "SELECT COUNT(*) as total FROM looker_laudopendente {$whereClause}";

        try {
            // Executa a query de contagem primeiro (com os mesmos parâmetros de busca)
            $totalResult = $conexaoRemota->execute($countQuery, $searchParams)->fetch('assoc');
            $total = $totalResult['total'];

            // Aplica paginação se não for exportação
            if (!$export && empty($searchParams)) {
                $dataQuery .= " LIMIT :limit OFFSET :offset";
                $params = array_merge($searchParams, [
                    'limit' => $limit,
                    'offset' => $offset
                ]);
            } else {
                $params = $searchParams;
            }
            // Copia a query original
            $queryLog = $dataQuery;

            // Substitui os placeholders pelos valores reais
            foreach ($params as $param) {
                $safeParam = is_string($param) ? addslashes($param) : $param; // Só aplica addslashes em strings
                $queryLog = preg_replace('/\?/', "'" . $safeParam . "'", $queryLog, 1);
            }
            
            // Loga a query final montada
            $this->log("Consulta SQL Final: " . $queryLog);
            // Loga a query final montada
            $this->log("Parâmetros: " . json_encode($params));

            // Executa a query de dados
            $results = $conexaoRemota->execute($dataQuery, $params)->fetchAll('assoc');

            return [
                'data' => $results,
                'total' => $total,         // Total sem filtro
                'filtered' => $total       // Total com filtro (será igual ao total quando não houver busca)
            ];
        } catch (\Exception $e) {
            $this->log("Erro na consulta: " . $e->getMessage());
            return [
                'data' => [],
                'total' => 0,
                'filtered' => 0
            ];
        }
    }
}