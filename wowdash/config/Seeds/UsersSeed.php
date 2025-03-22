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
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();
        $data = [];

        // Buscar o role "Admin"
        $rolesTable = $this->fetchTable('Roles');
        $adminRole = $rolesTable->find()->where(['name' => 'Admin'])->first();

        // Criar um admin real
        $data[] = [
            'name' => 'Admin User',
            'email' => 'admin@email.com',
            'password' => password_hash('senha_super_secreta', PASSWORD_DEFAULT),
            'role_id' => $adminRole ? $adminRole->id : null, // Associando o role 'admin'
            'profile_image' => 'admin_profile.jpg', // A imagem de perfil do admin
        ];

        // Criando usuários fake
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role_id' => $adminRole ? $adminRole->id : null, // Associando role, ou defina como 'user'
                'profile_image' => $faker->imageUrl(200, 200), // Imagem de perfil fake
            ];
        }

        $this->table('users')->insert($data)->save();
    }
}
