<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\ConnectionManager;

class ProgramacaoComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [];

    /**
     * Busca dados do banco remoto.
     *
     * @return array
     */
    public function buscarDadosRemotos($filter, $limit = 10, $offset = 0, $search = null, $export = false): array
    {
        // Obtém a conexão com o banco remoto
        $conexaoRemota = ConnectionManager::get('remote');

        // Se for uma exportação, retorna todos os dados
        if ($export) {
            // Ajuste a consulta para retornar todos os registros
            $query = "
                SELECT *
                FROM (
                    SELECT :filter as ambiente,
                        a.age_name,
                        loc_description,
                        l.loc_neighborhood,
                        l.loc_street,
                        tsk_priority,
                        tsk_scheduleinitialdatehour,
                        lor_executionorder,
                        :filter as e_servicos,
                        tsk_observation,
                        ROW_NUMBER() OVER (PARTITION BY t.age_id
                                            ORDER BY tsk_priority, lor_executionorder, tsk_scheduleinitialdatehour) AS RN
                    FROM u13953.Task AS t
                    INNER JOIN u13953.dbout_Local AS l ON t.loc_id = l.loc_id
                    INNER JOIN u13953.Agent AS a ON a.age_id = t.age_id
                    INNER JOIN u13953.LocalRoute AS lr ON lr.loc_id = l.loc_id
                    INNER JOIN u13953.Route AS r ON r.rot_id = lr.rot_id
                    WHERE tss_id <> 70 
                    AND tss_id < 50 
                    AND regexp_replace(loc_integrationid, '\D', '', 'g') <> '' 
                    AND regexp_replace(loc_integrationid, '\D', '', 'g')::bigint BETWEEN 20 AND 9999 
                    AND age_name LIKE 'EQUIPE%' 
                    AND r.rot_integrationid LIKE '%v2'
                ) AS CTE_RN
                WHERE RN <= 2;
            ";
            
            // Parâmetros para a consulta
            $params = [
                'filter' => $filter
            ];
        } else {
            // Query base
            $query = "
                SELECT *
                FROM (
                    SELECT :filter AS ambiente,
                        a.age_name,
                        loc_description,
                        l.loc_neighborhood,
                        l.loc_street,
                        tsk_priority,
                        tsk_scheduleinitialdatehour,
                        lor_executionorder,
                        :filter AS e_servicos,
                        tsk_observation,
                        ROW_NUMBER() OVER (PARTITION BY t.age_id
                                            ORDER BY tsk_priority, lor_executionorder, tsk_scheduleinitialdatehour) AS RN
                    FROM u13953.Task AS t
                    INNER JOIN u13953.dbout_Local AS l ON t.loc_id = l.loc_id
                    INNER JOIN u13953.Agent AS a ON a.age_id = t.age_id
                    INNER JOIN u13953.LocalRoute AS lr ON lr.loc_id = l.loc_id
                    INNER JOIN u13953.Route AS r ON r.rot_id = lr.rot_id
                    WHERE tss_id <> 70 
                    AND tss_id < 50 
                    AND regexp_replace(loc_integrationid, '\D', '', 'g') <> '' 
                    AND regexp_replace(loc_integrationid, '\D', '', 'g')::bigint BETWEEN 20 AND 9999 
                    AND age_name LIKE 'EQUIPE%' 
                    AND r.rot_integrationid LIKE '%v2'
            ";
            // Adiciona filtro de pesquisa, se houver
            if (!empty($search)) {
                $query .= " AND (
                    a.age_name ILIKE :search OR
                    loc_description ILIKE :search OR
                    tsk_observation ILIKE :search
                )";
            }
        
            $query .= ") AS CTE_RN
                WHERE RN <= 2
                LIMIT :limit OFFSET :offset;
            ";

            // Parâmetros para a consulta
            $params = [
                'filter' => $filter,
                'limit' => (int) $limit,
                'offset' => (int) $offset
            ];
        }
    
        // Se houver pesquisa, adiciona o parâmetro de busca
        if (!empty($search)) {
            $params['search'] = "%{$search}%";
        }
    
        // Executa a query com os parâmetros
        return $conexaoRemota->execute($query, $params)->fetchAll('assoc');
    }    
}