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
class MenusTable extends Table
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

        $this->setTable('menus');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    
        $this->addBehavior('Timestamp');
    
        $this->belongsTo('ParentMenus', [
            'className' => 'Menus',
            'foreignKey' => 'parent_id',
            'joinType' => 'LEFT', // Permite que o menu não tenha um menu pai
        ]);
    
        $this->belongsToMany('Roles', [
            'foreignKey' => 'menu_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'roles_menus', // Nome da tabela de junção
        ]);
    
        $this->hasMany('ChildMenus', [
            'className' => 'Menus',
            'foreignKey' => 'parent_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
      /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'Nome é obrigatório');

        // Validações adicionais aqui, caso necessário

        return $validator;
    }
}
