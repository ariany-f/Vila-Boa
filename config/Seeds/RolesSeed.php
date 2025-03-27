<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Roles seed.
 */
class RolesSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/4/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1, // ID fixo para garantir referência no outro seeder
                'nome' => 'Admin'
            ]
        ];

        // Insere na tabela roles
        $this->table('roles')->insert($data)->saveData();
    }
}
