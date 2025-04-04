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
        $conexaoRemota = ConnectionManager::get('remote_base');

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

    public function buscarDadosDiverso($limit = 10, $offset = 0, $search = null, $export = false)
    {
        // Obtém a conexão com o banco remoto
        $conexaoRemota = ConnectionManager::get('remote_capina');

        // Se for uma exportação, retorna todos os dados
        if ($export) {
            // Ajuste a consulta para retornar todos os registros
            $query = "
                SELECT age_name, loc_description, e_servicos, e_tipoatendimento, 
                    TO_CHAR(tsk_scheduleinitialdatehour, 'DD/MM/YYYY') as tsk_scheduleinitialdatehour, 
                    tsk_observation, e_caminhaodisposicao
                FROM (
                    SELECT a.age_name, CONCAT('REQUISIÇÃO - ', UPPER(l.loc_description)) as loc_description, 
                        e_servicos, l.e_tipoatendimento, tsk_scheduleinitialdatehour, 
                        TRIM(UPPER(t.tsk_observation)) as tsk_observation, e_caminhaodisposicao
                    FROM u29917.Task as t
                    INNER JOIN u29917.agent as a ON a.age_id = t.age_id
                    INNER JOIN u29917.dbout_local as l ON l.loc_id = t.loc_id
                    WHERE t.tty_id = 83060 AND tss_id < 50

                    UNION ALL

                    SELECT a.age_name, CONCAT('ATENDIMENTO AO BAIRRO - ', t.tea_description) as loc_description, 
                        'Capina de Guia, Sarjeta e Passeio - Pintura de Guias e Postes (Se necessário) - Limpeza Geral, Varrição, Raspagem de Terra' as e_servicos, 
                        'AtendimentoNormal' as e_tipoatendimento, NULL as tsk_scheduleinitialdatehour, NULL as tsk_observation, NULL as e_caminhaodisposicao
                    FROM u29917.team as t
                    INNER JOIN u29917.teamagent as ar ON ar.tea_id = t.tea_id
                    INNER JOIN u29917.agent as a ON a.age_id = ar.age_id
                    WHERE tea_description LIKE '%DIVERSOS%'
                ) as s1
                ORDER BY age_name, tsk_scheduleinitialdatehour;
            ";
            
            $params = [];
        } else {
            // Query base para quando não é exportação
            $query = "
                 SELECT age_name, loc_description, e_servicos, e_tipoatendimento, 
                    TO_CHAR(tsk_scheduleinitialdatehour, 'DD/MM/YYYY') as tsk_scheduleinitialdatehour, 
                    tsk_observation, e_caminhaodisposicao
                FROM (
                    SELECT a.age_name, CONCAT('REQUISIÇÃO - ', UPPER(l.loc_description)) as loc_description, 
                        e_servicos, l.e_tipoatendimento, tsk_scheduleinitialdatehour, 
                        TRIM(UPPER(t.tsk_observation)) as tsk_observation, e_caminhaodisposicao
                    FROM u29917.Task as t
                    INNER JOIN u29917.agent as a ON a.age_id = t.age_id
                    INNER JOIN u29917.dbout_local as l ON l.loc_id = t.loc_id
                    WHERE t.tty_id = 83060 AND tss_id < 50

                    UNION ALL

                    SELECT a.age_name, CONCAT('ATENDIMENTO AO BAIRRO - ', t.tea_description) as loc_description, 
                        'Capina de Guia, Sarjeta e Passeio - Pintura de Guias e Postes (Se necessário) - Limpeza Geral, Varrição, Raspagem de Terra' as e_servicos, 
                        'AtendimentoNormal' as e_tipoatendimento, NULL as tsk_scheduleinitialdatehour, NULL as tsk_observation, NULL as e_caminhaodisposicao
                    FROM u29917.team as t
                    INNER JOIN u29917.teamagent as ar ON ar.tea_id = t.tea_id
                    INNER JOIN u29917.agent as a ON a.age_id = ar.age_id
                    WHERE tea_description LIKE '%DIVERSOS%'
                ) as s1
                 WHERE 1 = 1
            ";
            // Se houver pesquisa, aplica o filtro de pesquisa
            if (!empty($search)) {
                $query .= " AND (loc_description LIKE :search OR age_name LIKE :search)";
            }

            $query .= " ORDER BY age_name, tsk_scheduleinitialdatehour
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