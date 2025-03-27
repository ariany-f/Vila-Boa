<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateRequisicoesLogs extends BaseMigration
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
        $table = $this->table('requisicoes_logs');
        $table->addColumn('payload', 'text', ['null' => false]) // Dados recebidos no webhook
              ->addColumn('status', 'string', ['limit' => 255]) // Status da requisição (sucesso ou erro)
              ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP']) // Timestamp da requisição
              ->create();
    }
}
