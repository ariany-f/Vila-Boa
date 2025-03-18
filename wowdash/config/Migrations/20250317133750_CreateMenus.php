<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMenus extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('menus');
        $table->addColumn('name', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('url', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('parent_id', 'integer', ['null' => true, 'default' => null])
              ->addColumn('position', 'integer', ['null' => false, 'default' => 0])
              ->addColumn('icon', 'string', ['limit' => 255, 'null' => true, 'default' => null])
              ->addColumn('allow_delete', 'boolean', ['default' => true]) // Define se pode ser excluído
              ->addTimestamps() // Adiciona 'created' e 'modified'
              ->create();
    }
}
