<?php
namespace App\Model\Table;

use App\Model\Entity\Programme;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Log\Log;
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

    public function getActiveProgramme()
    {
        return $this->find()
                    ->where(['is_published'=>1])
                    ->first();
    }

    public function setIsPublished($id, $status)
    {
        $entity = $this->get($id);
        $entity = $this->patchEntity($entity, [
            'is_published' => $status
        ]);
        
        return $this->save($entity);
    }

    public function unpublish($id)
    {
       return $this->setIsPublished($id, 0);
    }
    
    public function unpublishActive()
    {
        if($activeProgramme = $this->getActiveProgramme())
        {
            Log::write('debug', __('Unpublishing active programme {0}', $activeProgramme->name));
            return $this->unpublish($activeProgramme->id);
        }
        return false;
    }

    public function publish($id)
    {
        return $this->setIsPublished($id, 1);
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

        return $validator;
    }
}
