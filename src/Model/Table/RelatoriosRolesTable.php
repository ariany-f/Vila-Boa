<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RelatoriosRoles Model
 *
 * @property \App\Model\Table\RelatoriosTable&\Cake\ORM\Association\BelongsTo $Relatorios
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\RelatoriosRole newEmptyEntity()
 * @method \App\Model\Entity\RelatoriosRole newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RelatoriosRole> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RelatoriosRole get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RelatoriosRole findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RelatoriosRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RelatoriosRole> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RelatoriosRole|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RelatoriosRole saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RelatoriosRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RelatoriosRole>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RelatoriosRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RelatoriosRole> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RelatoriosRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RelatoriosRole>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RelatoriosRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RelatoriosRole> deleteManyOrFail(iterable $entities, array $options = [])
 */
class RelatoriosRolesTable extends Table
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

        $this->setTable('relatorios_roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['role_id', 'relatorio_id']);

        $this->belongsTo('Relatorios', [
            'foreignKey' => 'relatorio_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
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
            ->integer('relatorio_id')
            ->notEmptyString('relatorio_id');

        $validator
            ->integer('role_id')
            ->notEmptyString('role_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['relatorio_id'], 'Relatorios'), ['errorField' => 'relatorio_id']);
        $rules->add($rules->existsIn(['role_id'], 'Roles'), ['errorField' => 'role_id']);

        return $rules;
    }
}
