<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Home Controller
 *
 */
class HomeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        
        $this->loadComponent('CustomComponent', [
            'className' => 'Custom', // Nome da classe do componente
        ]);
    }

    
    public function blankpage()
    {
        $this->set('title', 'Blank Page');
        $this->set('subTitle', 'Blank Page');
    }

    public function atualizacaoLaudo()
    {
        $this->set('title', 'Laudos Pendentes');
        $this->set('subTitle', 'Atualização de Laudo');
    
        if ($this->request->is('ajax')) {
            // Captura parâmetros do DataTables
            $search = $this->request->getQuery('search') ?? null;
            $start = (int) $this->request->getQuery('start', 0);
            $length = (int) $this->request->getQuery('length', 10);
            $draw = (int) $this->request->getQuery('draw', 1);
            $isExport = $this->request->getQuery('export', false);
    
            // Busca dados paginados e totais em uma única chamada
            $result = $this->CustomComponent->atualizacaoLaudo($length, $start, $search, $isExport);
    
            // Retorna JSON para DataTables
            return $this->response->withType('application/json')->withStringBody(json_encode([
                'draw' => $draw,
                'recordsTotal' => $result['total'],
                'recordsFiltered' => empty($search) ? $result['total'] : $result['filtered'],
                'data' => $result['data']
            ]));
        }
    }

    public function calendar()
    {
        $this->set('title', 'Calendar');
        $this->set('subTitle', 'Components / Calendar');
    }

    public function chat()
    {
        $this->set('title', 'Chat');
        $this->set('subTitle', 'Chat');
    }

    public function chatProfile()
    {
        $this->set('title', 'Chat');
        $this->set('subTitle', 'Chat');
    }

    public function comingsoon()
    {
        $this->viewBuilder()->setLayout('layout2');
    }

    public function email()
    {
        $this->set('title', 'Email');
        $this->set('subTitle', 'Components / Email');
    }

    public function faqs()
    {
        $this->set('title', 'Faq');
        $this->set('subTitle', 'Faq');
    }

    public function gallery()
    {
        $this->set('title', 'Gallery');
        $this->set('subTitle', 'Gallery');
    }

    public function index()
    {
        $this->set('title', 'Início');
        $this->set('subTitle', 'Vila Boa');
    }

    public function kanban()
    {
        $this->set('title', 'Kanban');
        $this->set('subTitle', 'Kanban');
    }

    public function maintenance()
    {
        $this->viewBuilder()->setLayout('layout2');
    }

    public function notFound()
    {
        $this->set('title', '404');
        $this->set('subTitle', '404');
    }

    public function pricing()
    {
        $this->set('title', 'Pricing');
        $this->set('subTitle', 'Pricing');
    }

    public function stared()
    {
        $this->set('title', 'Email');
        $this->set('subTitle', 'Components / Email');
    }

    public function termsAndConditions()
    {
        $this->set('title', 'Terms & Condition');
        $this->set('subTitle', 'Terms & Condition');
    }

    public function testimonials()
    {
        $this->set('title', 'Testimonials');
        $this->set('subTitle', 'Testimonials');
    }

    public function viewDetails()
    {
        $this->set('title', 'Email');
        $this->set('subTitle', 'Components / Email');
    }

    public function widgets()
    {
        $this->set('title', 'Widgets');
        $this->set('subTitle', 'Widgets');
    }

}
