<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Relatorios Controller
 *
 * @property \App\Model\Table\RelatoriosTable $Relatorios
 * @property \App\Model\Table\RolesTable $Roles
 */
class RelatoriosController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->Roles = $this->fetchTable('Roles');
        $this->Users = $this->fetchTable('Users');
        
    }

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

        // Obtém os papéis para o select
        $roles = $this->Relatorios->Roles->find()->toArray();
        $this->set(compact('relatorios', 'relatorio', 'roles'));
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
    public function add()
    {
        $relatorio = $this->Relatorios->newEmptyEntity();

        if ($this->request->is('post')) {
            $relatorio = $this->Relatorios->patchEntity($relatorio, $this->request->getData());

            // Captura os valores do formulário
            $relatorio->titulo = $this->request->getData('titulo');
            $relatorio->descricao = $this->request->getData('descricao');
            $relatorio->link_iframe = $this->request->getData('link_iframe');
            $relatorio->user_id = $this->request->getSession()->read('Auth.User.id');
            $relatorio->data_criacao = date('Y-m-d H:i:s');

            // Extraímos os IDs das roles selecionadas
            $roleIds = $this->request->getData('roles._ids') ?: [];

            // Filtra apenas os IDs selecionados
            $selectedRoles = array_keys(array_filter($roleIds, function($value) {
                return $value == 1;
            }));

            // Busca os papéis no banco de dados
            $roles = $this->Relatorios->Roles->find('all', [
                'conditions' => ['Roles.id IN' => $selectedRoles]
            ])->toArray();

            // Associa os papéis ao relatório
            $relatorio->roles = $roles;

            if ($this->Relatorios->save($relatorio)) {
                $this->Flash->success(__('O relatório foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O relatório não pôde ser salvo. Por favor, tente novamente.'));
            }
        }

        // Obtém os papéis para exibir no formulário
        $roles = $this->Relatorios->Roles->find()->toArray();
        $this->set(compact('relatorio', 'roles'));
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
        $relatorio = $this->Relatorios->get($id, [
            'contain' => ['Roles'], // Traz as roles associadas ao relatório
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $relatorio = $this->Relatorios->patchEntity($relatorio, $this->request->getData());

            // Extraímos os menus selecionados (IDs dos menus marcados nos checkboxes)
            $roleIds = $this->request->getData('roles._ids') ?: []; 
        
            // Filtra os IDs onde o valor é 1 (menus selecionados)
            $selectedRoles = array_keys(array_filter($roleIds, function($value) {
                return $value == 1;
            }));

            // Recupera os menus com base nos IDs
            $roles = $this->Roles->find('all', [
                'conditions' => ['Roles.id IN' => $selectedRoles]
            ])->toArray();

            // Associa os menus ao papel (role)
            $relatorio->roles = $roles;

            if ($this->Relatorios->save($relatorio)) {
                $this->Flash->success(__('O relatório foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O relatório não pôde ser salvo. Por favor, tente novamente.'));
        }
    
        // Obtém os papéis para o select
        $roles = $this->Relatorios->Roles->find()->toArray();
        $this->set(compact('relatorio', 'roles'));
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
            $this->Flash->success(__('O relatório foi excluído'));
        } else {
            $this->Flash->error(__('The relatorio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function list()
    {
        $userId = $this->Authentication->getIdentity()->id;

       // Obtém os IDs dos papéis (roles) do usuário autenticado
        $userRole = $this->Users->Roles->find()
        ->matching('Users', fn($q) => $q->where(['Users.id' => $userId]))
        ->first();

        // Busca os relatórios associados ao papel do usuário
        $relatorios = $this->Relatorios->find()
            ->matching('Roles', fn($q) => $q->where(['Roles.id' => $userRole->id]))
            ->distinct(['Relatorios.id'])
            ->all();

        $this->set(compact('relatorios'));
    }
}
