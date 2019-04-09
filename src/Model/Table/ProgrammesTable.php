<?php
namespace App\Model\Table;

use App\Model\Entity\Programme;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Programmes Model
 *
 * @property \Cake\ORM\Association\HasMany $Groups
 */
class ProgrammesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('programmes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Groups', [
            'foreignKey' => 'programme_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('is_published', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_published', 'create')
            ->notEmpty('is_published');

        $validator
            ->add('is_notified', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_notified', 'create')
            ->notEmpty('is_notified');

        return $validator;
    }
}
