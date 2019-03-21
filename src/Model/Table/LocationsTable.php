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

    public function getAllLocations()
    {
        return $this->find()
                        ->select(['id'=>'Locations.id', 'region'=>'Regions.name',
                        'location' => 'Locations.name'
                        ])
                      ->contain('Regions')
                      ->all();
    }

    public function getAllLocationsAndChildren()
    {
        $entities = [];
        $areas = TableRegistry::get('areas');
        $locations = $this->getAllLocations();

        foreach($locations as $location)
        {
            $entities[$location->location] = [
                'region' => $location->region,
                'areas' => $areas->getAreasByLocationId($location->id)
            ];
        }

        return $entities;
    }

    public function getLocationsByRegionId($regionId)
    {
        $query = $this->find()
                    ->select(['name'])
                    ->where(['region_id'=>$regionId])
                    ->hydrate(false);

        return ArrayEntityBuilder::build($query, 'name');
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
