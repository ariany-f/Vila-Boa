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
        // Usa o componente para buscar os dados
        $resultados = $this->ProgramacaoComponent->buscarDadosRemotos();
        // Passa os resultados para a view
        $this->set(compact('resultados'));
    }
}
