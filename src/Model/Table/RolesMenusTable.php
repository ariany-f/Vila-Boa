<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RolesMenus Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\MenusTable&\Cake\ORM\Association\BelongsTo $Menus
 *
 * @method \App\Model\Entity\RolesMenu newEmptyEntity()
 * @method \App\Model\Entity\RolesMenu newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RolesMenu> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RolesMenu get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RolesMenu findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RolesMenu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RolesMenu> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RolesMenu|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RolesMenu saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RolesMenu>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RolesMenu>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RolesMenu>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RolesMenu> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RolesMenu>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RolesMenu>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RolesMenu>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RolesMenu> deleteManyOrFail(iterable $entities, array $options = [])
 */
class RolesMenusTable extends Table
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

        $this->setTable('roles_menus');
        $this->setDisplayField('id');

        $this->setPrimaryKey(['role_id', 'menu_id']);

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id',
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
            ->integer('role_id')
            ->notEmptyString('role_id');

        $validator
            ->integer('menu_id')
            ->notEmptyString('menu_id');

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
        $rules->add($rules->existsIn(['role_id'], 'Roles'), ['errorField' => 'role_id']);
        $rules->add($rules->existsIn(['menu_id'], 'Menus'), ['errorField' => 'menu_id']);

        return $rules;
    }
}
