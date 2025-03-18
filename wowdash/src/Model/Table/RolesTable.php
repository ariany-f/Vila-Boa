<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RolesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('roles');
        $this->setPrimaryKey('id');

        // Associação muitos-para-muitos com menus
        $this->belongsToMany('Menus', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'menu_id',
            'joinTable' => 'roles_menus'
        ]);

        $this->belongsToMany('Users', [
            'through' => 'UsersRoles',
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'user_id',
        ]);
    }
}
