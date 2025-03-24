<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Relatorios seed.
 */
class RelatoriosSeed extends BaseSeed
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
                'name' => 'Aguardando Enel',
                'url' => 'https://lookerstudio.google.com/embed/reporting/03b6a0ee-bc87-4d44-ab08-5e03238959a3',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Painel de Emergências',
                'url' => 'https://lookerstudio.google.com/embed/reporting/e7a4d99b-c185-42c3-8e33-c30df881d97f',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Pedidos de Urgência',
                'url' => 'http://lookerstudio.google.com/embed/reporting/4e8d8bb9-564b-43b0-a182-8206f76db3b8',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Listas de Substituição',
                'url' => 'https://lookerstudio.google.com/embed/reporting/556c993a-d64a-4d14-8aca-4d74b3cbf8bf',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Consulta de Endereços',
                'url' => 'https://lookerstudio.google.com/embed/reporting/8e2499fc-3587-4007-afac-80f1da8d7cfc',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Munck Pendente',
                'url' => 'https://lookerstudio.google.com/embed/reporting/2302912b-38a9-49aa-a49b-a6359766c342',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Laudos Pendentes',
                'url' => 'https://lookerstudio.google.com/embed/reporting/6de3ec49-3963-4b3d-b9db-7cb25d34e8eb',
                'created' => date('Y-m-d H:i:s'),
                'updated' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('relatorios');
        $table->insert($data)->save();
    }
}
