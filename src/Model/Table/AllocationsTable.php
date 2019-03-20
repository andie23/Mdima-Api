<?php
namespace App\Model\Table;

use App\Model\Entity\Allocation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Allocations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Areas
 * @property \Cake\ORM\Association\BelongsTo $Groups
 */
class AllocationsTable extends Table
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

        $this->table('allocations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Areas', [
            'foreignKey' => 'area_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);
    }
    public function allocationExists($groupId, $areaId)
    {
        return $this->find()
                    ->where(['group_id'=>$groupId,'area_id'=>$areaId])
                    ->count() >=1;
    }
    public function buildAreaAssignmentEntities($groupId, $areas)
    {
        $entities = [];

        foreach($areas as $area => $status)
        {
            $areaId = (int) str_replace('area_','', $area);
            $entities[] = [
                'area_id' => $areaId,
                'group_id' => $groupId
            ];
        }

        return $entities;
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

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['area_id'], 'Areas'));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        return $rules;
    }

    
}
