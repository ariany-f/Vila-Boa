<?php
use Migrations\AbstractMigration;

class CreateRoles extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('roles');
        $table->addColumn('nome', 'string', [
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
                'null' => false,
            ])
            ->create();
    }
}
