<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customizaveis Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Roles
 */
class CustomizaveisTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('customizaveis');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsToMany('Roles', [
            'through' => 'CustomizaveisRoles', // Certifique-se de que este nome de tabela está correto
            'foreignKey' => 'customizavel_id',  // Campo que referencia o user na tabela de junção
            'targetForeignKey' => 'role_id',  // Campo que referencia o role na tabela de junção
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('titulo')
            ->maxLength('titulo', 255)
            ->requirePresence('titulo', 'create')
            ->notEmptyString('titulo');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');
        
        $validator
            ->scalar('link_iframe')
            ->allowEmptyString('link_iframe');

        $validator
            ->dateTime('data_criacao')
            ->requirePresence('data_criacao', 'create')
            ->notEmptyDateTime('data_criacao');

        return $validator;
    }
}
