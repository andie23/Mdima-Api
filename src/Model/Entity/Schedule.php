<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity.
 *
 * @property int $id
 * @property int $duration
 * @property \Cake\I18n\Time $starting_date
 * @property \Cake\I18n\Time $ending_date
 * @property int $group_id
 * @property \App\Model\Entity\Group $group
 * @property string $name
 */
class Schedule extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
