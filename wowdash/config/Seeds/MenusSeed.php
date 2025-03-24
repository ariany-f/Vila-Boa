<?php
declare(strict_types=1);

use Cake\I18n\FrozenTime;
use Migrations\AbstractSeed;
use Cake\I18n\DateTime;

class MenusSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = (new DateTime())->format('Y-m-d H:i:s');
        
        $data = [
            // Menu Principal
            ['id' => 1, 'name' => 'Página Inicial', 'url' => '/', 'parent_id' => null, 'position' => 1, 'icon' => 'home', 'allow_delete' => false, 'created' => $now, 'modified' => $now],

            // Requisições
            ['id' => 2, 'name' => 'Requisições', 'url' => '#', 'parent_id' => null, 'position' => 2, 'icon' => 'inbox-check', 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 3, 'name' => 'Diversos', 'url' => '/requisicoes/diversos', 'parent_id' => 2, 'position' => 1, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 4, 'name' => 'Poda', 'url' => '/requisicoes/poda', 'parent_id' => 2, 'position' => 2, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 5, 'name' => 'Recolha', 'url' => '/requisicoes/recolha', 'parent_id' => 2, 'position' => 3, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],

            // Mapas
            ['id' => 6, 'name' => 'Mapas', 'url' => '#', 'parent_id' => null, 'position' => 3, 'icon' => 'map-marker', 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 7, 'name' => 'Roçada', 'url' => '/mapas/rocada', 'parent_id' => 6, 'position' => 1, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 8, 'name' => 'Capina', 'url' => '/mapas/capina', 'parent_id' => 6, 'position' => 2, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 9, 'name' => 'Poda', 'url' => '/mapas/poda', 'parent_id' => 6, 'position' => 3, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],

            // Programação
            ['id' => 10, 'name' => 'Programação', 'url' => '/programacao', 'parent_id' => null, 'position' => 4, 'icon' => 'calendar', 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 11, 'name' => 'Diversos', 'url' => '/programacao/diversos', 'parent_id' => 10, 'position' => 1, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 12, 'name' => 'Roçada', 'url' => '/programacao/rocada', 'parent_id' => 10, 'position' => 2, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],

            ['id' => 13, 'name' => 'Logs', 'url' => '/requisicoes', 'parent_id' => 2, 'position' => 3, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
           
            // Gerenciamento
            ['id' => 14, 'name' => 'Gerenciamento', 'url' => '#', 'parent_id' => null, 'position' => 5, 'icon' => 'settings', 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 15, 'name' => 'Usuários', 'url' => '/users', 'parent_id' => 14, 'position' => 1, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 16, 'name' => 'Menus', 'url' => '/menus', 'parent_id' => 14, 'position' => 2, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            ['id' => 17, 'name' => 'Relatórios', 'url' => '/relatorios/gerenciar', 'parent_id' => 14, 'position' => 3, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],

            // Acompanhamento
            ['id' => 18, 'name' => 'Acompanhamento', 'url' => '/acompanhamento', 'parent_id' => null, 'position' => 6, 'icon' => 'dashboard-chart-arrow', 'allow_delete' => false, 'created' => $now, 'modified' => $now],
            
            // Relatórios
            ['id' => 19, 'name' => 'Relatórios', 'url' => '/relatorios', 'parent_id' => null, 'position' => 7, 'icon' => 'dashboard-chart', 'allow_delete' => false, 'created' => $now, 'modified' => $now],

            ['id' => 21, 'name' => 'Permissões', 'url' => '/roles', 'parent_id' => 14, 'position' => 0, 'icon' => null, 'allow_delete' => false, 'created' => $now, 'modified' => $now],
        ];

        // Insere os dados
        $this->table('menus')->insert($data)->save();
    }
}
