<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RolesMenusFixture
 */
class RolesMenusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'roles_menus';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'role_id' => 1,
                'menu_id' => 1,
            ],
        ];
        parent::init();
    }
}
