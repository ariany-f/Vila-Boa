<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomizaveisRoles Model
 *
 * @property \App\Model\Table\CustomizaveisTable&\Cake\ORM\Association\BelongsTo $Customizaveis
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\CustomizaveisRole newEmptyEntity()
 * @method \App\Model\Entity\CustomizaveisRole newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CustomizaveisRole> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomizaveisRole get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CustomizaveisRole findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CustomizaveisRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CustomizaveisRole> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomizaveisRole|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CustomizaveisRole saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CustomizaveisRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomizaveisRole>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomizaveisRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomizaveisRole> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomizaveisRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomizaveisRole>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CustomizaveisRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CustomizaveisRole> deleteManyOrFail(iterable $entities, array $options = [])
 */
class CustomizaveisRolesTable extends Table
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

        $this->setTable('customizaveis_roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['role_id', 'customizavel_id']);

        $this->belongsTo('Customizaveis', [
            'foreignKey' => 'customizavel_id',
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
            ->integer('customizavel_id')
            ->notEmptyString('customizavel_id');

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
        $rules->add($rules->existsIn(['customizavel_id'], 'Customizaveis'), ['errorField' => 'customizavel_id']);
        $rules->add($rules->existsIn(['role_id'], 'Roles'), ['errorField' => 'role_id']);

        return $rules;
    }
}
