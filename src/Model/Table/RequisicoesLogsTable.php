<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RequisicoesLogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\RequisicoesLog newEmptyEntity()
 * @method \App\Model\Entity\RequisicoesLog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RequisicoesLog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequisicoesLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RequisicoesLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RequisicoesLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RequisicoesLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequisicoesLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RequisicoesLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RequisicoesLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RequisicoesLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RequisicoesLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RequisicoesLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RequisicoesLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RequisicoesLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RequisicoesLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RequisicoesLog> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequisicoesLogsTable extends Table
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

        $this->setTable('requisicoes_logs');
        $this->setDisplayField('status');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        // Adiciona associação com a tabela Users
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
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
            ->scalar('payload')
            ->requirePresence('payload', 'create')
            ->notEmptyString('payload');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Rules checker for application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules Rules instance.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Garante que user_id referencie um usuário válido na tabela users
        $rules->add($rules->existsIn('user_id', 'Users'), 'validUser', [
            'errorField' => 'user_id',
            'message' => 'O usuário associado não existe.',
        ]);

        return $rules;
    }
}
