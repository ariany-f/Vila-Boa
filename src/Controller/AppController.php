<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Authenticator\FormAuthenticator;
use Cake\Http\Session;
use Cake\Utility\Hash;


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
    protected $Menus;
    protected $UsersRoles;
    
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
        if ($usuario) 
        {
            $usuarioId = $usuario->get('id');
            $menus = $this->request->getSession()->read('menus.' . $usuarioId);

            if (!$menus) {
                $usuario = $this->getTableLocator()->get('Users')->get($usuario->get('id'), [
                    'contain' => ['Roles'],
                ]);
    
                $roles = $usuario->get('roles') ?? [];
                 
                if($roles) {

                    $roleIds = array_map(function ($role) {
                        return $role->id;
                    }, $roles);
                    // Buscar menus no banco de dados
                    $menus = $this->Menus->find()
                        ->matching('Roles', function ($q) use ($roleIds) {
                            return $q->where(['Roles.id IN' => $roleIds]);
                        })
                        ->contain(['ChildMenus' => function ($q) {
                            return $q->contain(['Roles']); // Inclui a relação com Roles para as ChildMenus
                        }])
                        ->where(['Menus.parent_id IS' => null])
                        ->order(['Menus.position' => 'ASC'])
                        ->all();
                        
                         // Filtrar os menus filhos, garantindo que só serão exibidos aqueles que possuem roles associadas
                        foreach ($menus as $menu) {
                            // Verificar se o menu tem filhos
                            if (!empty($menu->child_menus)) {
                                // Filtra os filhos que têm pelo menos um role associado
                                $menu->child_menus = array_filter($menu->child_menus, function ($child) use ($roleIds) {
                                    // Verifique se $child->roles não é null e é um array
                                    if (!empty($child->roles) && is_array($child->roles)) {
                                        return !empty(array_intersect($roleIds, Hash::extract($child->roles, '{n}.id')));
                                    }
                                    return false; // Caso $child->roles seja null ou não seja um array, filtra o item
                                });
                            }
                        }
                }
                else
                {
                    $menus = [];
                }
                    
                // Armazenar os menus na sessão
                $this->request->getSession()->write('menus.' . $usuarioId, $menus);
            }
               
            // Tornar os menus e o usuário disponíveis para todas as views
            $this->set(compact('menus', 'usuario'));
        } else {
            // Caso o usuário não esteja logado, redireciona ou não carrega os menus
            $this->set('menus', []);
        }
    }
}
