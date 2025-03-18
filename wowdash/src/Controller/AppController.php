<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Authenticator\FormAuthenticator;
use Cake\Http\Session;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 * 
 * @property \App\Model\Table\MenusTable $Menus
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        $this->Menus = $this->fetchTable('Menus');
        $this->UsersRoles = $this->fetchTable('UsersRoles');
        
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        $this->loadComponent('Authentication.Authentication');
        
        // Verifica se o usuário está logado
        $usuario = $this->Authentication->getIdentity();
        if ($usuario) {
           
             // Buscar o usuário na tabela Users e carregar as associações de 'Roles'
            $usuario = $this->getTableLocator()->get('Users')->get($usuario->get('id'), [
                'contain' => ['Roles'],
            ]);

            $roles = $usuario->get('roles') ?? [];
           
            if($roles) {

                $roleIds = array_map(function ($role) {
                    return $role->id;
                }, $roles);

                // Carregar os menus disponíveis para o usuário, com base nos roles
                $menus = $this->Menus->find()
                ->matching('Roles', function ($q) use ($roleIds) {
                    return $q->where(['Roles.id IN' => $roleIds]);
                })
                ->contain(['ChildMenus'])  // Carregar submenus
                ->where(['Menus.parent_id IS' => null])  // Filtrar menus principais
                ->order(['Menus.position' => 'ASC'])
                ->all();
            }
            else
            {
                $menus = [];
            }
            
            // Tornar os menus e o usuário disponíveis para todas as views
            $this->set(compact('menus', 'usuario'));
        } else {
            // Caso o usuário não esteja logado, redireciona ou não carrega os menus
            $this->set('menus', []);
        }
    }
}
