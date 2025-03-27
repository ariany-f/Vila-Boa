<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Mapas Controller
 *
 */
class MapasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Mapas->find();
        $mapas = $this->paginate($query);

        $this->set(compact('mapas'));
    }

    /**
     * View method
     *
     * @param string|null $id Mapa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mapa = $this->Mapas->get($id, contain: []);
        $this->set(compact('mapa'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mapa = $this->Mapas->newEmptyEntity();
        if ($this->request->is('post')) {
            $mapa = $this->Mapas->patchEntity($mapa, $this->request->getData());
            if ($this->Mapas->save($mapa)) {
                $this->Flash->success(__('The mapa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mapa could not be saved. Please, try again.'));
        }
        $this->set(compact('mapa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mapa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mapa = $this->Mapas->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mapa = $this->Mapas->patchEntity($mapa, $this->request->getData());
            if ($this->Mapas->save($mapa)) {
                $this->Flash->success(__('The mapa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mapa could not be saved. Please, try again.'));
        }
        $this->set(compact('mapa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mapa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mapa = $this->Mapas->get($id);
        if ($this->Mapas->delete($mapa)) {
            $this->Flash->success(__('The mapa has been deleted.'));
        } else {
            $this->Flash->error(__('The mapa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function rocada()
    {
        $this->set('title', 'Mapas');
        $this->set('subTitle', 'Roçada');
    }

    public function capina()
    {
        $this->set('title', 'Mapas');
        $this->set('subTitle', 'Capina');
    }

    public function poda()
    {
        $this->set('title', 'Mapas');
        $this->set('subTitle', 'Poda');
    }
}
