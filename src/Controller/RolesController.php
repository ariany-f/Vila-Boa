<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->set('title', 'Permissões');
        $this->set('subTitle', 'Gerenciar');

        $query = $this->Roles->find();
        $roles = $this->paginate($query);

        $this->set(compact('roles'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->set('title', 'Permissão');
        $this->set('subTitle', 'Detalhes');

        $role = $this->Roles->get($id, contain: ['Menus', 'Users']);
        $this->set(compact('role'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->set('title', 'Permissão');
        $this->set('subTitle', 'Adicionar');

        // Criando uma nova entidade Role
        $role = $this->Roles->newEmptyEntity();

        if ($this->request->is('post')) {
           
            $data = $this->request->getData();

            // Verifique e converta os valores dos IDs de menus para inteiros
            if (isset($data['menus']['_ids']) && is_array($data['menus']['_ids'])) {
                $data['menus']['_ids'] = array_map('intval', array_keys($data['menus']['_ids']));
            }
            
            // Agora, aplique os dados ao objeto $role
            $role = $this->Roles->patchEntity($role, $data);

            // Extraímos os menus selecionados (IDs dos menus marcados nos checkboxes)
            $menuIds = $this->request->getData('menus._ids') ?: []; 
            
            // Filtra os IDs onde o valor é 1 (menus selecionados)
            $selectedMenuIds = array_keys(array_filter($menuIds, function($value) {
                return $value == 'on';
            }));

            // Recupera os menus com base nos IDs
            $menus = $this->Menus->find('all', [
                'conditions' => ['Menus.id IN' => $selectedMenuIds]
            ])->toArray();

            // Associa os menus ao papel (role)
            $role->menus = $menus;

            // Tenta salvar a entidade Role com os menus associados
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('A permissão foi salva'));

                // Redireciona para a lista de roles
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('A permissão não pôde ser salva. Tente novamente mais tarde.'));
        }

        // Recupera todos os menus para a seleção
        $allMenus = $this->Roles->Menus->find('all')->contain(['ChildMenus'])->toArray();

        // Passa as variáveis para a view
        $this->set(compact('role', 'allMenus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('title', 'Permissão');
        $this->set('subTitle', 'Editar');

        $role = $this->Roles->get($id, contain: ['Menus']);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            // Verifique e converta os valores dos IDs de menus para inteiros
            if (isset($data['menus']['_ids']) && is_array($data['menus']['_ids'])) {
                $data['menus']['_ids'] = array_map('intval', array_keys($data['menus']['_ids']));
            }
            
            // Agora, aplique os dados ao objeto $role
            $role = $this->Roles->patchEntity($role, $data);

            // Extraímos os menus selecionados (IDs dos menus marcados nos checkboxes)
            $menuIds = $this->request->getData('menus._ids') ?: [];             
           
            // Filtra os IDs onde o valor é 1 (menus selecionados)
            $selectedMenuIds = array_keys(array_filter($menuIds, function($value) {
                return $value == 'on';
            }));

            // Recupera os menus com base nos IDs
            $menus = $this->Menus->find('all', [
                'conditions' => ['Menus.id IN' => $selectedMenuIds]
            ])->toArray();

            // Associa os menus ao papel
            $role->menus = $menus;

            // Tenta salvar a entidade do papel com os menus associados
            if ($this->Roles->save($role)) {
                // Verifica se a role salva é a mesma que a do usuário logado
                $loggedUserRoleId = $this->Authentication->getIdentity(); // Supondo que 'role_id' esteja no objeto de identidade do usuário
              
                $usuario = $this->getTableLocator()->get('Users')->get($loggedUserRoleId->id, [
                    'contain' => ['Roles'],
                ]);
    
                $roles = $usuario->get('roles') ?? [];
                $roleIds = array_map(function ($role) {
                    return $role->id;
                }, $roles);

                if ($role->id === $roleIds[0]) {
                    $usuario = $this->Authentication->getIdentity();
                    $usuarioId = $usuario->get('id');
                    $this->request->getSession()->delete('menus.' . $usuarioId);
                }
                
                $this->Flash->success(__('A permissão foi salva'));
                return $this->redirect($this->referer());
            }
            
            $this->Flash->error(__('A permissão não pôde ser salva. Tente novamente mais tarde.'));
        }

        $menuEdit = $this->Roles->Menus->find('list')->toArray();
        $allMenus = $this->Roles->Menus->find('all')->contain(['ChildMenus'])->toArray();

        $this->set(compact('role', 'menuEdit', 'allMenus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
