<?php
namespace App\Model\Table;

use App\Model\Entity\Allocation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Lib\ArrayEntityBuilder;
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

    public function getAreasAssigned($groupId)
    {
        $query = $this->find()
                      ->contain('Areas')
                      ->select(['area'=>'Areas.name'])
                      ->where(['Allocations.group_id'=>$groupId]);
        return ArrayEntityBuilder::buildArrayList($query, 'area');
    }
    
    public function getRegionsAssigned($groupId)
    {
        $query = $this->find()
                      ->select(['region'=>'regions.name'])
                      ->where(['Allocations.group_id'=>$groupId])
                      ->innerJoin('areas', 'areas.id=Allocations.area_id')
                      ->innerJoin('locations', 'locations.id=areas.location_id')
                      ->innerJoin('regions', 'locations.region_id=regions.id')
                      ->distinct('region');
    
        return ArrayEntityBuilder::buildArrayList($query, 'region');
    }

    public function getLocationsAssigned($groupId){
        $query = $this->find()
                      ->select(['location'=>'locations.name'])
                      ->where(['Allocations.group_id'=>$groupId])
                      ->innerJoin('areas', 'areas.id=Allocations.area_id')
                      ->innerJoin('locations', 'locations.id=areas.location_id')
                      ->distinct('location');
        return ArrayEntityBuilder::buildArrayList($query, 'location');
    }

    private function getGroupBy($id, $table)
    {
        $query = $this->find()
                      ->select(['name'=>'Groups.name'])
                      ->contain('Groups')
                      ->where([__('{0}.id', $table) => $id])
                      ->innerJoin('areas', 'areas.id=Allocations.area_id')
                      ->innerJoin('locations', 'areas.location_id=locations.id')
                      ->innerJoin('regions', 'regions.id=locations.region_id')
                      ->distinct('group_id')
                      ->hydrate(false);
        return ArrayEntityBuilder::buildArrayList($query, 'name');
    }

    public function getAreaBlackoutGroup($areaId)
    {
        $name = 'name';
        $groupId = 'groupId';
        $query = $this->find()
                    ->select(['name' => 'Groups.name', 'groupId'  => 'Groups.id'])
                    ->contain('Groups')
                    ->where(['area_id' => $areaId])
                    ->max('group_id');
        return $query!=null ? [$name => $query->name, $groupId=>$query->groupId] : 
            [$name => '', $groupId=>''];
    }

    public function getRelatedAffectedAreasCount($areaId, $group)
    {
        $count = $this->find()
                      ->where([
                            'area_id !='=> $areaId,
                            'group_id'=>$group
                       ])->count('area_id');
        return $count !=null ?  (int) $count : 0;
    }

    private function getAreasCountAffected($id, $table)
    {

        $count = $this->find()
                    ->select(['blackouts' => 'COUNT(area_id)'])
                    ->where([__('{0}.id', $table) => $id])
                    ->innerJoin('areas', 'areas.id=Allocations.area_id')
                    ->innerJoin('locations', 'locations.id=areas.location_id')
                    ->innerJoin('regions', 'regions.id = locations.region_id')
                    ->first()
                    ->blackouts;
        return $count!=null ? (int) $count : 0;
    }

    public function getBlackoutAreasByRegion($regionId)
    {
        return $this->getAreasCountAffected($regionId, 'regions');
    }

    public function getBlackoutAreasByLocation($locationId)
    {
        return $this->getAreasCountAffected($locationId, 'locations');
    }

    public function getRegionBlackoutCount($regionId)
    {
        return $this->getBlackoutCount($regionId, 'regions');
    }

    public function getGroupsByAreaId($areaId)
    {
        return $this->getGroupBy($areaId, 'areas');
    }

    public function getGroupsByRegionId($regionId)
    {
        return $this->getGroupBy($regionId, 'regions');
    }

    public function getGroupsByLocationId($locationId)
    {
       return $this->getGroupBy($locationId, 'locations');
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
