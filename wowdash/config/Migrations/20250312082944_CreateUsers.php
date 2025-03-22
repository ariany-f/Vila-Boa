<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateUsers extends BaseMigration
{
    /**
     * Change Method.
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        
        // Adicionando os campos para nome, foto de perfil e role
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        
        $table->addColumn('profile_image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true, // Permitir valor nulo, pois nem todos os usuários podem ter imagem de perfil
        ]);
        
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        
        $table->create();
    }
}
