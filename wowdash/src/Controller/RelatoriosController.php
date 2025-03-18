<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Relatorios Controller
 *
 * @property \App\Model\Table\RelatoriosTable $Relatorios
 */
class RelatoriosController extends AppController
{
    /**
     * Método executado antes de renderizar qualquer view.
     *
     * @return void
     */
    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        parent::beforeRender($event);

        // Defina o título e subtítulo compartilhado aqui
        $this->set('title', 'Relatórios');
        $this->set('subTitle', 'Todos os relatórios disponíveis');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Relatorios->find();
        $relatorios = $this->paginate($query);
    
        // Criar uma entidade vazia para o formulário
        $relatorio = $this->Relatorios->newEmptyEntity();

        $this->set(compact('relatorios', 'relatorio'));
    }

    /**
     * View method
     *
     * @param string|null $id Relatorio id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $relatorio = $this->Relatorios->get($id, contain: []);
        $this->set(compact('relatorio'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($relatorio = null)
    {
        if ($this->request->is('post') && $relatorio) {
            $relatorio = $this->Relatorios->patchEntity($relatorio, $this->request->getData());
            if ($this->Relatorios->save($relatorio)) {
                $this->Flash->success(__('The relatorio has been saved.'));
                return $this->redirect(['action' => 'index']); // Redireciona para a página de índice
            }
            $this->Flash->error(__('The relatorio could not be saved. Please, try again.'));
        }
        else
        {
            $relatorio = $this->Relatorios->newEmptyEntity();
            $relatorio->titulo = $this->request->getData('titulo');
            $relatorio->descricao = $this->request->getData('descricao');
            $relatorio->link_iframe = $this->request->getData('link_iframe');
            $relatorio->user_id = $this->request->getSession()->read('Auth.User.id');
            $relatorio->data_criacao = date('Y-m-d H:i:s');
            if ($this->Relatorios->save($relatorio)) {
                $this->Flash->success(__('The relatorio has been saved.'));
                return $this->redirect(['action' => 'index']); // Redireciona para a página de índice
            }
            else
            {
                $this->Flash->error(__('The relatorio could not be saved. Please, try again.'));
                return $this->redirect(['action' => 'index']); // Redireciona para a página de índice
            }
        }
        
        // Não é necessário renderizar um template, pois o formulário está no modal
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Relatorio id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $relatorio = $this->Relatorios->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $relatorio = $this->Relatorios->patchEntity($relatorio, $this->request->getData());
            if ($this->Relatorios->save($relatorio)) {
                $this->Flash->success(__('The relatorio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The relatorio could not be saved. Please, try again.'));
        }
        $this->set(compact('relatorio'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Relatorio id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $relatorio = $this->Relatorios->get($id);
        if ($this->Relatorios->delete($relatorio)) {
            $this->Flash->success(__('The relatorio has been deleted.'));
        } else {
            $this->Flash->error(__('The relatorio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function list()
    {
        $relatorios = $this->Relatorios->find()->all();
        $this->set(compact('relatorios'));
    }
}
