<?php
declare(strict_types=1);

use Migrations\BaseSeed;
use Faker\Factory;

/**
 * Users seed.
 */
class UsersSeed extends BaseSeed
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
        $faker = Factory::create();
        $data = [];

        $adminRole = $rolesTable->find()->where(['nome' => 'Admin'])->first();

        // Criando um admin real
        $data[] = [
            'email' => 'admin@email.com',
            'password' => password_hash('senha_super_secreta', PASSWORD_DEFAULT),
            'roles' => [$adminRole], // Associando o role 'admin'
        ];

        // Criando usuários fake
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'email' => $faker->email,
                'password' => password_hash('123456', PASSWORD_DEFAULT)
            ];
        }

        $this->table('users')->insert($data)->save();
    }
}
