<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddFieldsRequisicoesLogs extends BaseMigration
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

        // Adiciona a coluna user_id (usuário responsável)
        $table->addColumn('user_id', 'integer', [
            'null' => true, // Pode ser opcional ou obrigatório, dependendo da regra de negócio
            'default' => null,
        ]);

        // Adiciona a coluna origem (ação que chamou a gravação)
        $table->addColumn('origem', 'string', [
            'limit' => 255, // Tamanho máximo da string
            'null' => false, // Defina como true se quiser permitir valores nulos
            'default' => '',
        ]);

        // Salva as alterações na tabela
        $table->update();
    }
}
