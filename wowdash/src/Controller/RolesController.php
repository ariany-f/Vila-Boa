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
            // Obtém os dados do formulário e aplica na entidade Role
            $role = $this->Roles->patchEntity($role, $this->request->getData());

            // Extraímos os menus selecionados (IDs dos menus marcados nos checkboxes)
            $menuIds = $this->request->getData('menus._ids') ?: []; 
            
            // Filtra os IDs onde o valor é 1 (menus selecionados)
            $selectedMenuIds = array_keys(array_filter($menuIds, function($value) {
                return $value == 1;
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
            // Obtém os dados do formulário
            $role = $this->Roles->patchEntity($role, $this->request->getData());

            // Extraímos os menus selecionados (IDs dos menus marcados nos checkboxes)
            $menuIds = $this->request->getData('menus._ids') ?: [];             
                        
            // Filtra os IDs onde o valor é 1 (menus selecionados)
            $selectedMenuIds = array_keys(array_filter($menuIds, function($value) {
                return $value == 1;
            }));

            // Recupera os menus com base nos IDs
            $menus = $this->Menus->find('all', [
                'conditions' => ['Menus.id IN' => $selectedMenuIds]
            ])->toArray();

            // Associa os menus ao papel
            $role->menus = $menus;

            // Tenta salvar a entidade do papel com os menus associados
            if ($this->Roles->save($role)) {
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
