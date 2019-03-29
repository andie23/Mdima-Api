<?php
namespace App\Model\Table;

use App\Model\Entity\Region;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Regions Model
 *
 * @property \Cake\ORM\Association\HasMany $Locations
 */
class RegionsTable extends Table
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

        $this->table('regions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Locations', [
            'foreignKey' => 'region_id'
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

    public function getRegionIndex()
    {
        $regionEntity = [];
        $regions = $this->getAllRegions();
        foreach($regions as $region)
        {
            $regionEntity[$region->name] = [
                'region' => $region->name
            ];
        }
        return $regionEntity;
    }
    public function getAllRegions()
    {
        return $this->find()
                    ->all();
    }

    public function getAllRegionData()
    {
        $entity = [];
        $locations = TableRegistry::get('locations');
        $allocations = TableRegistry::get('allocations');
        $schedules = TableRegistry::get('schedules');
        $areas = TableRegistry::get('areas');
        $regions = $this->getAllRegions();

        foreach ($regions as $region){
            $entity[$region->name] = [
               'region' => $region->name,
               'numberOfAreas' => (string) $areas->getAreasByRegionId($region->id)->count(),
               'numberOfLocations' => (string) count($locations->getLocationListForRegion($region->id)),
               'numberOfBlackouts' => (string) $schedules->getRegionBlackoutCount($region->id),
               'numberOfAreasAffected' => $allocations->getBlackoutAreasByRegion($region->id)
            ];
        }
        return $entity;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
}
