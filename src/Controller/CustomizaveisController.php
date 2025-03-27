<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Customizaveis Controller
 *
 * @property \App\Model\Table\CustomizaveisTable $Customizaveis
 * @property \App\Model\Table\RolesTable $Roles
 * @property \App\Model\Table\MenusTable $Menus
 * @property \App\Model\Table\UsersTable $Users
 */
class CustomizaveisController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->Roles = $this->fetchTable('Roles');
        $this->Menus = $this->fetchTable('Menus');
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
        $this->set('title', 'Telas Customizadas');
        $this->set('subTitle', 'Todas as telas disponíveis');
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Customizaveis->find();
        $customizaveis = $this->paginate($query);
    
        // Criar uma entidade vazia para o formulário
        $customizavel = $this->Customizaveis->newEmptyEntity();

        // Obtém os papéis para o select
        $roles = $this->Customizaveis->Roles->find()->toArray();  
        
    
        $menusView = $this->Menus->find()
        ->contain(['ParentMenus'])
        ->order(['Menus.id' => 'ASC']) // Ordenação crescente por ID
        ->all();

        $parentMenus = $this->Menus->find()
        ->select(['id', 'name', 'icon']) // Seleciona os campos necessários
        ->where(['parent_id IS' => null]) // Filtra apenas menus sem parent_id
        ->all();

        $this->set(compact('customizaveis', 'customizavel', 'roles','menusView', 'parentMenus'));
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
        $customizavel = $this->Customizaveis->get($id, contain: []);
        $this->set(compact('customizavel'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customizavel = $this->Customizaveis->newEmptyEntity();

        if ($this->request->is('post')) {
            $customizavel = $this->Customizaveis->patchEntity($customizavel, $this->request->getData());

            // Captura os valores do formulário
            $customizavel->titulo = $this->request->getData('titulo');
            $customizavel->descricao = $this->request->getData('descricao');
            $customizavel->link_iframe = $this->request->getData('link_iframe');
            $customizavel->user_id = $this->request->getSession()->read('Auth.User.id');
            $customizavel->data_criacao = date('Y-m-d H:i:s');
            $criar_menu = $this->request->getData('criar_menu');

            // Extraímos os IDs das roles selecionadas
            $roleIds = $this->request->getData('roles._ids') ?: [];

            // Filtra apenas os IDs selecionados
            $selectedRoles = array_keys(array_filter($roleIds, function($value) {
                return $value == 1;
            }));

            // Busca os papéis no banco de dados
            $roles = $this->Customizaveis->Roles->find('all', [
                'conditions' => ['Roles.id IN' => $selectedRoles]
            ])->toArray();

            // Associa os papéis ao relatório
            $customizavel->roles = $roles;

            if ($this->Customizaveis->save($customizavel)) {
                if( $criar_menu )
                {
                    $menu = $this->Menus->newEmptyEntity();
                    $menu->name = $customizavel->titulo;
                    $menu->parent_id = $this->request->getData('parent_id');
                    $menu->url = "/custom/view/" . $customizavel->id;
                    $menu->icone = $this->request->getData('icon'); // Ícone padrão, pode ser customizado
                    $menu->roles = $roles;
    
                    if (!$this->Menus->save($menu)) {
                        $this->Flash->error(__('A tela foi salva, mas o menu não pôde ser criado.'));
                    }

                    $usuario = $this->Authentication->getIdentity();
                    $usuarioId = $usuario->get('id');
                    $this->request->getSession()->delete('menus.' . $usuarioId);
                }
                $this->Flash->success(__('A tela foi salva com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('A tela não pôde ser salva. Por favor, tente novamente.'));
            }
        }

        // Obtém os papéis para exibir no formulário
        $roles = $this->Customizaveis->Roles->find()->toArray();
        $this->set(compact('customizavel', 'roles'));
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
        $customizavel = $this->Customizaveis->get($id, [
            'contain' => ['Roles'], // Traz as roles associadas ao relatório
        ]);

        $menu = $this->Menus->find()
        ->where(['url LIKE' => "%custom/view/{$customizavel->id}%"])
        ->first();

        $parentMenus = $this->Menus->find()
        ->select(['id', 'name', 'icon']) // Seleciona os campos necessários
        ->where(['parent_id IS' => null]) // Filtra apenas menus sem parent_id
        ->all();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $customizavel = $this->Customizaveis->patchEntity($customizavel, $this->request->getData());

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
            $customizavel->roles = $roles;

            if ($this->Customizaveis->save($customizavel)) {

                if ($this->request->getData('criar_menu')) {
                    if (!$menu) {
                        $menu = $this->Menus->newEmptyEntity();
                    }
                    $menu->name = $customizavel->titulo;
                    $menu->url = "/custom/view/" . $customizavel->id;
                    $menu->parent_id = $this->request->getData('parent_id') ?: null;
                    $menu->icone = $this->request->getData('icon') ?: 'mage:settings';
                    $menu->roles = $roles;

                    $this->Menus->save($menu);
                } else {
                    if ($menu) {
                        $this->Menus->delete($menu);
                    }
                }

                $this->Flash->success(__('A tela foi salva com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A tela não pôde ser salva. Por favor, tente novamente.'));
        }
    
        // Obtém os papéis para o select
        $roles = $this->Customizaveis->Roles->find()->toArray();
        $this->set(compact('customizavel', 'roles', 'menu', 'parentMenus'));
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
        $customizavel = $this->Customizaveis->get($id);

        $menu = $this->Menus->find()
        ->where(['url LIKE' => "%custom/view/{$customizavel->id}%"])
        ->first();

          // Se houver um menu vinculado, excluí-lo
        if ($menu) {
            $this->Menus->delete($menu);
            $usuario = $this->Authentication->getIdentity();
            $usuarioId = $usuario->get('id');
            $this->request->getSession()->delete('menus.' . $usuarioId);
        }

        if ($this->Customizaveis->delete($customizavel)) {
            $this->Flash->success(__('A tela foi excluída'));
        } else {
            $this->Flash->error(__('The customizavel could not be deleted. Please, try again.'));
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
        $customizaveis = $this->Customizaveis->find()
            ->matching('Roles', fn($q) => $q->where(['Roles.id' => $userRole->id]))
            ->distinct(['Customizaveis.id'])
            ->all();

        $this->set(compact('customizaveis'));
    }
}
