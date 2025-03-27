<?php
use Migrations\AbstractMigration;

class CreateRolesMenus extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('roles_menus');
        $table->addColumn('role_id', 'integer', ['null' => false])
              ->addColumn('menu_id', 'integer', ['null' => false])
              ->addForeignKey('role_id', 'roles', 'id', [
                  'delete'=> 'CASCADE',
                  'update'=> 'NO_ACTION'
              ])
              ->addForeignKey('menu_id', 'menus', 'id', [
                  'delete'=> 'CASCADE',
                  'update'=> 'NO_ACTION'
              ])
              ->create();
    }
}
