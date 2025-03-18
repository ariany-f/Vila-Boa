<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Relatorios Model
 *
 * @method \App\Model\Entity\Relatorio newEmptyEntity()
 * @method \App\Model\Entity\Relatorio newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Relatorio> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Relatorio get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Relatorio findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Relatorio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Relatorio> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Relatorio|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Relatorio saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Relatorio>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Relatorio>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Relatorio>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Relatorio> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Relatorio>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Relatorio>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Relatorio>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Relatorio> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RelatoriosTable extends Table
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

        $this->setTable('relatorios');
        $this->setDisplayField('titulo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
