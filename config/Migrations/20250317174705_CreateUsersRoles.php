<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateUsersRoles extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users_roles');
        $table->addColumn('user_id', 'integer', [
            'null' => false,
            'limit' => 10,
        ]);
        $table->addColumn('role_id', 'integer', [
            'null' => false,
            'limit' => 10,
        ]);
        $table->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE']);
        $table->addForeignKey('role_id', 'roles', 'id', ['delete' => 'CASCADE']);
        $table->create();
    }
}
