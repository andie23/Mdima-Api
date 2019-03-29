<?php
namespace App\Model\Table;

use App\Model\Entity\Summary;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Summary Model
 *
 */
class SummaryTable extends Table
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

        $this->table('summary');

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
            ->allowEmpty('blackout_count');

        $validator
            ->add('starting_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('starting_date');

        $validator
            ->add('ending_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('ending_date');

        $validator
            ->allowEmpty('areas_affected');

        $validator
            ->allowEmpty('regions_affected');

        $validator
            ->add('date', 'valid', ['rule' => 'date'])
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        return $validator;
    }

    public function getSummary()
    {
        $summary = $this->find()->first();
        if($summary!=null){
            return [
                'areasAffected' => $summary->areas_affected,
                'blackoutCount' => $summary->blackout_count,
                'date' => $summary->date,
                'startingDate' => $summary->starting_date,
                'endingDate' => $summary->ending_date,
                'regionsAffected' => $summary->regions_affected,
            ];
        }
        return [];
    }
}
