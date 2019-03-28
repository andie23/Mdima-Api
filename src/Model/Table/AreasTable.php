<?php
namespace App\Model\Table;

use App\Model\Entity\Area;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use App\Lib\ArrayEntityBuilder;

/**
 * Areas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Locations
 * @property \Cake\ORM\Association\HasMany $Allocations
 */
class AreasTable extends Table
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

        $this->table('areas');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Allocations', [
            'foreignKey' => 'area_id'
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

        return $validator;
    }

    public function getAreasByRegionId($regionId)
    {
        return $this->find()
                    ->contain('Locations')
                    ->select(['id'=>'Areas.id', 'area'=>'Areas.name','location'=>'Locations.name'])
                    ->where(['Locations.region_id'=>$regionId]);
    }

    public function getAreaIndex()
    {
        return ArrayEntityBuilder::buildAssocArray(
            $this->getAllAreas()->hydrate(false), 'area'
        );
    }

    public function getAreasByLocationId($locationId)
    {
        $query = $this->find()
                    ->select('name')
                    ->where(['location_id'=>$locationId]);
        
        return ArrayEntityBuilder::buildArrayList($query, 'name');
    }
   
    public function getAllAreas($conditions=[])
    {
        return $this->find()
                    ->select(['area'=>'Areas.name', 
                        'location'=>'Locations.name',
                        'region' => 'regions.name'
                    ])
                    ->where($conditions)
                    ->innerJoin('locations', 'locations.id=Areas.location_id')
                    ->innerJoin('regions', 'regions.id=Locations.region_id');
    }

    public function getAllAreaData($conditions=[])
    {
        $entity = [];
        $allocations = TableRegistry::get('allocations');
        $schedules = TableRegistry::get('schedules');
        $areas = $this->getAllAreas($conditions);

        foreach ($areas as $area){
            $blackoutDates = $schedules->getAreaBlackoutDates($area->id);
            $areaGroup = $allocations->getAreaBlackoutGroup($area->id);
            $entity[$area->area] = [
               'area' => $area->area,
               'location' => $area->location,
               'region' => $area->region,
               'group' => $areaGroup['name'],
               'startsOn' => $blackoutDates['startingDate'] ,
               'endsOn' => $blackoutDates['endingDate'],
               'numberOfBlackouts' => $schedules->getAreaBlackoutCount($area->id),
               'averageDuration' => $schedules->getAreaAvgBlackoutDurition($area->id),
               'similarAreasAffected' => $allocations->getRelatedAffectedAreasCount($area->id, $areaGroup['groupId'])
            ];
        }
        return $entity;
    }

    
    
    public function getAllAreaDataByLocations()
    {
        $groupedAreas = [];
        $locations= TableRegistry::get('locations')->find()->all();

        foreach($locations as $location)
        {
            $areas = $this->getAllAreaData(['locations.id' => $location->id]);
            if(!empty($areas))
            {
                $groupedAreas[$location->name] = $areas;
            }

        }
        return $groupedAreas;
    }

    public function getAreasGroupedIntoRegions()
    {
        $groupedAreas = [];
        $regionsTable = TableRegistry::get('regions');
        $allRegions = $regionsTable->find()->all();

        foreach($allRegions as $region)
        {
            $groupedAreas[$region->name] = $this->getAreasByRegionId($region->id);
        }
        return $groupedAreas;
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
        $rules->add($rules->isUnique(['name']));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        return $rules;
    }
}
