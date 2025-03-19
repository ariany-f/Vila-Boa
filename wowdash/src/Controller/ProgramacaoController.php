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
        $resultados = $this->ProgramacaoComponent->buscarDadosRemotos();
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
        $resultados = $this->ProgramacaoComponent->buscarDadosRemotos();
        // Passa os resultados para a view
        $this->set(compact('resultados'));
    }
}
