<?php
namespace App\Model\Table;

use App\Model\Entity\Group;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \Cake\ORM\Association\HasMany $Allocations
 * @property \Cake\ORM\Association\HasMany $Schedules
 */
class GroupsTable extends Table
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

        $this->table('groups');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Programmes',[
            'foreignKey' => 'programme_id'
        ]);

        $this->hasMany('Allocations', [
            'foreignKey' => 'group_id'
        ]);
        $this->hasMany('Schedules', [
            'foreignKey' => 'group_id'
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
            ->requirePresence('programme_id', 'create')
            ->notEmpty('programme_id');
            
        return $validator;
    }
    
    public function isGroupNameExists($programmeId, $groupName)
    {
        return $this->find()
                    ->where(['programme_id'=>$programmeId,'name'=> $groupName])
                    ->count() >= 1;

    }

    public function getAllGroups()
    {
        return $this->find()->all();
    }
    public function getActiveGroups()
    {
        $activeProgramme = $this->Programmes->getActiveProgramme();
        if ($activeProgramme){
            return $this->find()
                        ->where(['programme_id' => $activeProgramme->id]);
        }
        return [];
    }
    public function getGroupSchedules()
    {
        $entity = [];
        $schedules = TableRegistry::get('schedules');
        $groups = $this->getActiveGroups();
        foreach($groups as $group)
        {
            $entity[$group->id] = $schedules->getSchedulesByGroup($group->id);
        }
        return $entity;
    }

    public function getAllGroupsAndChildren()
    {
        $entity = [];
        $schedules = TableRegistry::get('schedules');
        $allocations = TableRegistry::get('allocations');
        $groups = $this->getAllGroups();

        foreach($groups as $group)
        {
            $entity[$group->name] = [
                'group' => $group->name,
                'areas' => $allocations->getAreasAssigned($group->id),
                'regions' => $allocations->getRegionsAssigned($group->id),
                'locations' => $allocations->getLocationsAssigned($group->id)
            ];
        }

        return $entity;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['programme_id'], 'Programmes'));
        return $rules;
    }

}
