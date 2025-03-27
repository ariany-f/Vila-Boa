<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * RolesMenus seed.
 */
class RolesMenusSeed extends BaseSeed
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
        // Pega todos os menus cadastrados
        $menus = $this->fetchAll('SELECT id FROM menus');

        // Assumindo que o admin tem ID = 1
        $adminRoleId = 1;
        $data = [];

        foreach ($menus as $menu) {
            $data[] = [
                'role_id' => $adminRoleId,
                'menu_id' => $menu['id'],
            ];
        }

        if (!empty($data)) {
            $this->table('roles_menus')->insert($data)->saveData();
        }
    }
}
