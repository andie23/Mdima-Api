<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReportsFixture
 *
 */
class ReportsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'students_without_tutors' => ['type' => 'biginteger', 'length' => 21, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'average_messages_per_tutor' => ['type' => 'decimal', 'length' => 14, 'precision' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'recent_messages_count' => ['type' => 'biginteger', 'length' => 21, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'inactive_students' => ['type' => 'biginteger', 'length' => 21, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => '0000-00-00', 'comment' => '', 'precision' => null],
        '_options' => [
            'engine' => null,
            'collation' => null
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'students_without_tutors' => '',
            'average_messages_per_tutor' => '',
            'recent_messages_count' => '',
            'inactive_students' => '',
            'date' => '2018-10-03'
        ],
    ];
}
