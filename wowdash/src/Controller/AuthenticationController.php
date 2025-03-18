<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Authentication Controller
 *
 */
class AuthenticationController extends AppController
{    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        $this->Authentication->allowUnauthenticated(['signin', 'signup']);
    }

    public function forgotPassword()
    {
        $this->viewBuilder()->setLayout('layout2');
    }

    public function signin()
    {
        $this->viewBuilder()->setLayout('layout2');

        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result && $result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/';
            return $this->redirect($target);
        }
        if ($this->request->is('post')) {
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
        return $this->redirect(['controller' => 'Authentication', 'action' => 'signin']);
    }
}
