<?php
declare(strict_types=1);

namespace App\Controller;
use Authentication\PasswordHasher\DefaultPasswordHasher; // how to use my file instead this?

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

    public function add()
    {
        $this->set('title', 'Adicionar Usuário');
        $this->set('subTitle', 'Adicionar Novo Usuário');
    
         // Cria uma nova entidade de usuário
        $user = $this->Users->newEmptyEntity();

        // Obtém todos os papéis da tabela 'users_roles'
        $roles = $this->Users->Roles->find('list')->toArray();
        
        if ($this->request->is('post')) {
            // Preenche os dados do formulário na entidade de usuário
            $user = $this->Users->patchEntity($user, $this->request->getData());

            // Criptografa a senha
            if (!empty($user->password)) {
                $hasher = new DefaultPasswordHasher();
                $user->password = $hasher->hash($user->password);
            }
            
            if ($this->request->getData('role_ids')) {
                // Aqui garantimos que apenas o primeiro papel seja atribuído
                $roleId = $this->request->getData('role_ids'); // Pega o primeiro item no array de IDs
                $role = $this->Users->Roles->get($roleId); // Obtém o papel selecionado
                $user->set('roles', [$role]); // Atribui o papel ao usuário
            }

            // Verificando se há um arquivo de imagem
            if (!empty($this->request->getData('profile_image')['tmp_name'])) {
                $profileImage = $this->request->getData('profile_image');
                $imageName = uniqid() . '-' . $profileImage['name'];
                move_uploaded_file($profileImage['tmp_name'], WWW_ROOT . 'img' . DS . 'profiles' . DS . $imageName);
                $user->profile_image = $imageName;
            }

            // Salva o usuário no banco de dados
            if ($this->Users->save($user)) {

                $this->Flash->success('Usuário criado com sucesso!');
                return $this->redirect(['action' => 'index']);
            } else {
                // Exibe os erros específicos
                $errors = $user->getErrors();
                $errorMessages = '';
                foreach ($errors as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        $errorMessages .= ucfirst($field) . ': ' . $error . '<br>';
                    }
                }
                $this->Flash->error('Erro ao criar o usuário: <br>' . $errorMessages);
            }

        }
    
        // Passa a entidade para o template
        $this->set(compact('user', 'roles'));
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
        $this->set('title', 'Usuário');
        $this->set('subTitle', 'Perfil');

        // Supondo que você esteja usando a autenticação para pegar o usuário logado
        $userId = $this->Authentication->getIdentity()->id; // Pega os dados do usuário logado
       
        // Carrega as informações adicionais do banco se necessário
        $user = $this->Users->find()
            ->where(['id' => $userId])
            ->contain('Roles')
            ->first();

        // Obtém os papéis para o select
        $roles = $this->Users->Roles->find('list')->toArray();

        // Passa os dados do usuário para a view
        $this->set(compact('user', 'roles'));
    }

    public function forgotPassword()
    {
        $this->viewBuilder()->setLayout('layout2');
    }

    public function index()
    {
        $this->set('title', 'Usuários');
        $this->set('subTitle', 'Todos os usuários disponíveis');

        $users = $this->Users->find('all');
        $loggedUserId = $this->Authentication->getIdentity()->id;

        // Criar uma entidade vazia para o formulário
        $user = $this->Users->newEmptyEntity();

        $this->set(compact('users', 'user', 'loggedUserId'));
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
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']); // Permite apenas POST ou DELETE para esta ação
    
        try {
            $user = $this->Users->get($id); // Obter o usuário pelo ID
            if ($this->Users->delete($user)) {
                $this->Flash->success('Usuário excluído com sucesso!');
            } else {
                $this->Flash->error('Erro ao excluir o usuário.');
            }
        } catch (\Exception $e) {
            $this->Flash->error('Usuário não encontrado.');
        }
    
        return $this->redirect(['action' => 'index']);
    }

    public function changePassword($id = null)
    {
        $this->set('title', 'Alterar Senha');
        $this->set('subTitle', 'Atualize sua senha');

        $user = $this->Users->find()
            ->where(['id' => $id])
            ->first();

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $hasher = new DefaultPasswordHasher();

            // Verifica se a senha atual está correta
            if ($data['new_password'] !== $data['confirm_password']) {
                $this->Flash->error('A nova senha e a confirmação não coincidem.');
            } else {
                // Atualiza a senha
                $user->password = $hasher->hash($data['new_password']);

                if ($this->Users->save($user)) {
                    $this->Flash->success('Senha alterada com sucesso.');
                    return $this->redirect($this->referer());
                }
                $this->Flash->error('Erro ao alterar a senha.');
            }
        }

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $this->set('title', 'Usuários');
        $this->set('subTitle', 'Editar');
        
        $user = $this->Users->find()
            ->where(['id' => $id])
            ->contain('Roles')
            ->first();

        unset($user->password);

        if ($this->request->is(['post', 'put'])) {

            $data = $this->request->getData();

            // Se 'profile_image' estiver vazia, remove do array
            if (empty($data['profile_image']->getClientFilename())) {
                unset($data['profile_image']);
            }
        
            $user = $this->Users->patchEntity($user, $data);

            if ($this->request->getData('role_ids')) {
                // Aqui garantimos que apenas o primeiro papel seja atribuído
                $roleId = $this->request->getData('role_ids'); // Pega o primeiro item no array de IDs
                $role = $this->Users->Roles->get($roleId); // Obtém o papel selecionado
                $user->set('roles', [$role]); // Atribui o papel ao usuário
            }
    
            // Lida com o upload da imagem de perfil
            $image = $this->request->getData('profile_image');
        
            // Verifica se um arquivo foi enviado
            if (!empty($image->getClientFilename())) {
                $file = $image;
                $filename = time() . '-' . $file->getClientFilename();
                $uploadPath = WWW_ROOT . 'assets/uploads' . DS . $filename;
                
                // Move o arquivo para a pasta uploads
                $file->moveTo($uploadPath);

                // Salva o nome do arquivo no banco
                $user->profile_image = 'assets/uploads/' . $filename;
            } else {
                unset($user->profile_image); // Se nenhum arquivo foi enviado, remove a chave
            }

            if ($this->Users->save($user)) {

                // Atualiza a identidade do usuário logado na sessão
                $loggedUser = $this->Authentication->getIdentity();
                if ($loggedUser->id == $user->id) {
                    $this->Authentication->setIdentity($user);
                }

                $this->Flash->success('Usuário atualizado com sucesso.');
                return $this->redirect($this->referer());
            }
    
            $this->Flash->error('Não foi possível atualizar o usuário.');
        }
    
        // Obtém os papéis para o select
        $roles = $this->Users->Roles->find('list')->toArray();
        $this->set(compact('user', 'roles'));
    }
}
