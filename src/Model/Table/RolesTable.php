<?php 
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RolesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('roles');
        $this->setPrimaryKey('id');

        // Associação muitos-para-muitos com Menus
        $this->belongsToMany('Menus', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'menu_id',
            'joinTable' => 'roles_menus'
        ]);

        // Associação muitos-para-muitos com Users
        $this->belongsToMany('Users', [
            'through' => 'UsersRoles',
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'user_id',
        ]);

        // Associação muitos-para-muitos com Relatorios
        $this->belongsToMany('Relatorios', [
            'through' => 'RelatoriosRoles',
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'relatorio_id'
        ]);
    }
}
