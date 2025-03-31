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
    public function add($menu = null)
    {
        if ($this->request->is('post') && $menu) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The relatorio has been saved.'));
                return $this->redirect(['action' => 'index']); // Redireciona para a página de índice
            }
            $this->Flash->error(__('The relatorio could not be saved. Please, try again.'));
        }
        else
        {
            $menu = $this->Menus->newEmptyEntity();
            $menu->name = $this->request->getData('name');
            $menu->url = $this->request->getData('url');
            $icon = $this->request->getData('icon');
            $icon = ($icon && $icon !== 'null') ? preg_replace('/^mage:/', '', $icon) : null;

            $menu->icon = $icon;
            $parent_id = $this->request->getData('parent_id');
            $menu->parent_id = (($parent_id && $parent_id != 'null') ? $parent_id : null);
            
            $menu->data_criacao = date('Y-m-d H:i:s');
            
            if ($this->Menus->save($menu)) {
                
                $usuario = $this->Authentication->getIdentity();
                $usuarioId = $usuario->get('id');
                $this->request->getSession()->delete('menus.' . $usuarioId);

                $this->Flash->success(__('O menu foi salvo com sucesso.'));
                return $this->redirect(['action' => 'index']); // Redireciona para a página de índice
            }
            else
            {
                $this->Flash->error(__('O menu não pôde ser salvo. Tente novamente.'));
                return $this->redirect(['action' => 'index']); // Redireciona para a página de índice
            }
        }
        
        // Não é necessário renderizar um template, pois o formulário está no modal
        return $this->redirect(['action' => 'index']);
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
            $icon = $this->request->getData('icon');
            $icon = ($icon && $icon !== 'null') ? preg_replace('/^mage:/', '', $icon) : null;
            $menu->icon = $icon;
            if ($this->Menus->save($menu)) {  
                $usuario = $this->Authentication->getIdentity();
                $usuarioId = $usuario->get('id');
                $this->request->getSession()->delete('menus.' . $usuarioId);
                $this->Flash->success(__('The menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O menu não pôde ser salvo. Tente novamente.'));
        }

        $parentMenus = $this->Menus->find()
        ->select(['id', 'name', 'icon']) // Seleciona os campos necessários
        ->where(['parent_id IS' => null]) // Filtra apenas menus sem parent_id
        ->all();

        // Busca todas as roles disponíveis
        $roles = $this->Menus->Roles->find('list')->all();
        
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
        
        // Atualiza os menus filhos para remover a referência ao menu pai
        $this->Menus->updateAll(['parent_id' => null], ['parent_id' => $id]);
        
        if ($this->Menus->delete($menu)) {  
            $usuario = $this->Authentication->getIdentity();
            $usuarioId = $usuario->get('id');
            $this->request->getSession()->delete('menus.' . $usuarioId);
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
