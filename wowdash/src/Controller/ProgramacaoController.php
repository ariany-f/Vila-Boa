<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Programacao Controller
 *
 */
class ProgramacaoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        
        $this->loadComponent('ProgramacaoComponent', [
            'className' => 'Programacao', // Nome da classe do componente
        ]);
    }

    /**
     * Index method
     *
     */
    public function index()
    {
        $this->set('title', 'Programação');
        $this->set('subTitle', '');
        // Usa o componente para buscar os dados
        $resultados = $this->ProgramacaoComponent->buscarDadosRemotos();
        // Passa os resultados para a view
        $this->set(compact('resultados'));
    }

    /**
     * Poda method
     *
     */
    public function poda()
    {
        $this->set('title', 'Programação');
        $this->set('subTitle', 'Poda');
        // Usa o componente para buscar os dados
        $resultados = $this->ProgramacaoComponent->buscarDadosRemotos('Poda');
        // Passa os resultados para a view
        $this->set(compact('resultados'));
    }

    /**
     * Capina method
     *
     */
    public function capina()
    {
        $this->set('title', 'Programação');
        $this->set('subTitle', 'Capina');
        // Usa o componente para buscar os dados
        $resultados = $this->ProgramacaoComponent->buscarDadosRemotos('Capina');
        // Passa os resultados para a view
        $this->set(compact('resultados'));
    }

    /**
     * Roçada method
     *
     */
    public function rocada()
    {
        $this->set('title', 'Programação');
        $this->set('subTitle', 'Capina');

        if ($this->request->is('ajax')) {
            // Captura parâmetros do DataTables
            $search = $this->request->getQuery('search')['value'] ?? null;
            $start = (int) $this->request->getQuery('start', 0);
            $length = (int) $this->request->getQuery('length', 10);
            $draw = (int) $this->request->getQuery('draw', 1);
            $isExport = $this->request->getQuery('export');
    
            // Busca dados paginados do banco
            $dados = $this->ProgramacaoComponent->buscarDadosRemotos('Roçada', $length, $start, $search, $isExport);
    
            // Conta o total de registros
            $totalRecords = count($this->ProgramacaoComponent->buscarDadosRemotos('Roçada', PHP_INT_MAX, 0));
    
            // Retorna JSON para DataTables
            return $this->response->withType('application/json')->withStringBody(json_encode([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => empty($search) ? $totalRecords : count($dados),
                'data' => array_values($dados)
            ]));
        }
    
        // Renderiza a view normalmente para acessos normais
        $resultados = $this->ProgramacaoComponent->buscarDadosRemotos('Roçada');
        $this->set(compact('resultados'));
    }
}
