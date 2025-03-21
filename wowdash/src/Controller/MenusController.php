<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Menus Controller
 *
 * @property \App\Model\Table\MenusTable $Menus
 */
class MenusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->set('title', 'Menus');
        $this->set('subTitle', 'Todos os menus disponíveis');
        
        $menusView = $this->Menus->find()
            ->contain(['ParentMenus'])
            ->order(['Menus.id' => 'ASC']) // Ordenação crescente por ID
            ->all();

        $parentMenus = $this->Menus->find()
        ->select(['id', 'name', 'icon']) // Seleciona os campos necessários
        ->where(['parent_id IS' => null]) // Filtra apenas menus sem parent_id
        ->all();

        // Busca todas as roles disponíveis
        $roles = $this->Menus->Roles->find('list')->all();

        $this->set(compact('menusView', 'parentMenus', 'roles'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menu = $this->Menus->get($id, contain: ['ParentMenus', 'Roles', 'ChildMenus']);
        $this->set(compact('menu'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $menu = $this->Menus->newEmptyEntity();
    
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $menu = $this->Menus->patchEntity($menu, $data);

            // Adiciona a data de criação
            $menu->data_criacao = date('Y-m-d H:i:s');

            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('O menu foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O menu não pôde ser salvo. Tente novamente.'));
        }

        // Busca os menus que podem ser pais
        $parentMenus = $this->Menus->find('list')->all();
        // Busca todas as roles disponíveis
        $roles = $this->Menus->Roles->find('list')->all();

        $this->set(compact('menu', 'parentMenus', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menu = $this->Menus->get($id, contain: ['Roles']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O menu não pôde ser salvo. Tente novamente.'));
        }
        $parentMenus = $this->Menus->ParentMenus->find('list', limit: 200)->all();
        $roles = $this->Menus->Roles->find('list', limit: 200)->all();
        $this->set(compact('menu', 'parentMenus', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
