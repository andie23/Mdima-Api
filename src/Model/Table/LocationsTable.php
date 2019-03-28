<?php
namespace App\Model\Table;

use App\Model\Entity\Location;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use App\Lib\ArrayEntityBuilder;
/**
 * Locations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Regions
 * @property \Cake\ORM\Association\HasMany $Areas
 */
class LocationsTable extends Table
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

        $this->table('locations');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Areas', [
            'foreignKey' => 'location_id'
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

    public function getAllLocationDataByRegions()
    {
        $groupedLocations = [];
        $regions = TableRegistry::get('regions')->find()->all();

        foreach($regions as $region)
        {
            $groupedLocations[$region->name] = $this->getLocationData(['region_id' => $region->id]);
        }
        return $groupedLocations;
    }

    public function getLocationData($condition)
    {
        $entities = [];
        $areas = TableRegistry::get('areas');
        $allocations = TableRegistry::get('allocations');
        $regions = TableRegistry::get('regions')->getAllRegions();
        $locations = $this->getAllLocations($condition);
        $schedules = TableRegistry::get('schedules');

        foreach($locations as $location)
        {
            $entities[$location->location] = [
                'location' => $location->location,
                'region' => $location->region,
                'areas' => count($areas->getAreasByLocationId($location->id)),
                'numberOfBlackouts' => $schedules->getLocationBlackoutCount($location->id),
                'numberOfAreasAffected' => $allocations->getBlackoutAreasByLocation($location->id)
            ];
        }
        return $entities;
    }


    public function getLocationIndex()
    {
        return ArrayEntityBuilder::buildAssocArray(
            $this->getAllLocations(), 'location'
        );
    }

    public function getAllLocations($conditions=[])
    {
        return $this->find()
                        ->select(['region'=>'Regions.name',
                        'location' => 'Locations.name'
                        ])
                      ->where($conditions)
                      ->contain('Regions');
    }

    public function getLocationListForRegion($regionId)
    {
        return ArrayEntityBuilder::buildArrayList(
            $this->getAllLocations(['
                region_id'=>$regionId])->hydrate(false), 
                'location');
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
        $rules->add($rules->existsIn(['region_id'], 'Regions'));
        return $rules;
    }
}
