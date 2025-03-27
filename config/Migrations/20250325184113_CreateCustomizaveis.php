<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateCustomizaveis extends BaseMigration
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
        $table = $this->table('customizaveis');
        $table->addColumn('titulo', 'string', ['limit' => 255])
              ->addColumn('descricao', 'text', ['null' => true])
              ->addColumn('data_criacao', 'datetime')
              ->addColumn('link_iframe', 'text', ['null' => true])  // Adicionando o campo link_iframe
              ->addTimestamps()  // Cria automaticamente as colunas created e modified
              ->create();
    }
}
