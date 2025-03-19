<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        $this->Authentication->allowUnauthenticated(['signin', 'signup']);
    }

    public function addUser()
    {
        $this->set('title', 'Add User');
        $this->set('subTitle', 'Add User');
    }

    public function usersGrid()
    {
        $this->set('title', 'Users Grid');
        $this->set('subTitle', 'Users Grid');
    }

    public function usersList()
    {
        $this->set('title', 'Users List');
        $this->set('subTitle', 'Users List');
    }

    public function viewProfile()
    {
        $this->set('title', 'Perfil');
        $this->set('subTitle', 'Perfil');
    }

    public function forgotPassword()
    {
        $this->viewBuilder()->setLayout('layout2');
    }

    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);
    
        // Criar uma entidade vazia para o formulário
        $user = $this->Users->newEmptyEntity();

        $this->set(compact('users', 'user'));
    }

    public function signin()
    {
        $this->viewBuilder()->setLayout('layout2');
        
        if ($this->request->is('post')) {
            
            $result = $this->Authentication->getResult();
            
            if ($result && $result->isValid()) {
                $target = $this->Authentication->getLoginRedirect() ?? '/';
                
                return $this->redirect($target);
            }
        
            // Caso contrário, exibe a mensagem de erro
            $this->Flash->error('Invalid username or password');
        }
    }

    public function signup()
    {
        $this->viewBuilder()->setLayout('layout2');
    }
    
    public function signout()
    {
        $this->Authentication->logout();
        $session = $this->request->getSession();
        $session->destroy(); // Apaga todos os dados da sessão
        return $this->redirect(['controller' => 'Authentication', 'action' => 'signin']);
    }
}
