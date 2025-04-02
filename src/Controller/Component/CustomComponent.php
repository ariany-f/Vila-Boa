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
        // Obtém a conexão com o banco remoto
        $conexaoRemota = ConnectionManager::get('remote_capina');

        // Se for uma exportação, retorna todos os dados
        if ($export) {
            // Ajuste a consulta para retornar todos os registros
            $query = "SELECT loc_datetimeinsert, e_tipoatendimento,loc_id,loc_description,e_bairro , tsk_situation,e_acoesnecessarias from looker_laudopendente 
WHERE e_laudopendente = 'Sim' AND e_servico = 'Remocao' AND tss_id <= '40' ";
            
            $params = [];
        } else {
            // Query base para quando não é exportação
            $query = "SELECT loc_datetimeinsert, e_tipoatendimento,loc_id,loc_description,e_bairro , tsk_situation,e_acoesnecessarias from looker_laudopendente 
WHERE e_laudopendente = 'Sim' AND e_servico = 'Remocao' AND tss_id <= '40' 
            ";

            // Se houver pesquisa, aplica o filtro de pesquisa
            if (!empty($search)) {
                // $query .= " AND (loc_description LIKE :search OR age_name LIKE :search)";
            }

            $query .= " ORDER BY loc_datetimeinsert
                  LIMIT {$limit} OFFSET {$offset};
            ";

            // Se houver pesquisa, adiciona o parâmetro de busca
            if (!empty($search)) {
                $params['search'] = "%{$search}%";
            }
            else{
                $params = [];
            }
            
        }

        // Executa a query com os parâmetros
        return $conexaoRemota->execute($query, $params)->fetchAll('assoc');
    }

}