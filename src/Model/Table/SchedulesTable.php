<?php
namespace App\Model\Table;

use App\Model\Entity\Schedule;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Lib\ArrayEntityBuilder;
/**
 * Schedules Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Groups
 */
class SchedulesTable extends Table
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

        $this->table('schedules');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
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
            ->add('starting_date', 'valid', ['rule' => 'datetime'])
            ->requirePresence('starting_date', 'create')
            ->notEmpty('starting_date');

        $validator
            ->add('ending_date', 'valid', ['rule' => 'datetime'])
            ->requirePresence('ending_date', 'create')
            ->notEmpty('ending_date');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public function getDurationInHours($startDate, $endDate)
    {
        $startDateObj = new \DateTime(date('Y-m-d G:i:s', strtotime($startDate)));
        $endDateObj = new \DateTime(date('Y-m-d G:i:s', strtotime($endDate))); 
        return $startDateObj->diff($endDateObj)->h;
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
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        return $rules;
    }

    public function getBlackoutCount($id, $table)
    {
        $count = $this->find()
                    ->select(['blackouts' => "COUNT(DISTINCT Schedules.id)"])
                    ->where([__('{0}.id', $table) => $id])
                    ->innerJoin('allocations', 'Schedules.group_id=Allocations.group_id')
                    ->innerJoin('areas', 'areas.id=Allocations.area_id')
                    ->innerJoin('locations', 'areas.location_id=locations.id')
                    ->innerJoin('regions', 'regions.id=locations.region_id')
                    ->first()
                    ->blackouts;
        return $count!=null ? $count : 0;
    }

    public function getAreaBlackoutDates($areaId)
    {
        $startingDate = 'startingDate';
        $endingDate = 'endingDate';
        $blackoutDates = $this->find()
                              ->select([
                                  'starting_date' => 'min(starting_date)',
                                  'ending_date' => 'max(ending_date)'
                              ])
                              ->innerJoin('allocations', 'allocations.group_id = schedules.group_id')
                              ->where(['allocations.area_id' => $areaId])
                              ->first();
        if ($blackoutDates->starting_date!= null and $blackoutDates->ending_date!=null)
        {
            return [
                $startingDate => $blackoutDates->starting_date,
                $endingDate => $blackoutDates->ending_date
            ];
        }
        return [$startingDate => "N/A", $endingDate => 'N/A'];
    }

    private function getAverageBlackoutDuration($id, $table)
    {
        $average = $this->find()
                    ->select(['average' => 'avg(schedules.duration)'])
                    ->where([__('{0}.id', $table) => $id])
                    ->innerJoin('allocations', 'allocations.group_id = Schedules.group_id')
                    ->innerJoin('areas', 'areas.id=allocations.area_id')
                    ->innerJoin('locations', 'locations.id=areas.location_id')
                    ->innerJoin('regions', 'regions.id=locations.region_id')
                    ->first()
                    ->average;
        return $average!= null ? (int) $average : 0;
    }

    public function getAreaAvgBlackoutDurition($areaId)
    {
        return $this->getAverageBlackoutDuration($areaId, 'areas');
    }

    public function getAreaBlackoutCount($areaId)
    {
        return $this->getBlackoutCount($areaId, 'areas');
    }

    public function getRegionBlackoutCount($regionId)
    {
        return $this->getBlackoutCount($regionId, 'regions');
    }

    public function getLocationBlackoutCount($locationId)
    {
        return $this->getBlackoutCount($locationId, 'locations');
    }

    public function getSchedules()
    {
        $query = $this->find()
                      ->select([
                          'name' => 'Schedules.name', 'duration', 'startingDate'=>'starting_date',
                          'endingDate' => 'ending_date', 'group'=>'Groups.name'])
                      ->contain('Groups')
                      ->hydrate(false);
        return ArrayEntityBuilder::buildAssocArray($query, 'group');
    }
}
