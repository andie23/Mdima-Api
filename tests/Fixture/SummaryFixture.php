<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SummaryFixture
 *
 */
class SummaryFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'summary';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'blackout_count' => ['type' => 'biginteger', 'length' => 21, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'starting_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ending_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'areas_affected' => ['type' => 'biginteger', 'length' => 21, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'regions_affected' => ['type' => 'biginteger', 'length' => 21, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
            'blackout_count' => '',
            'starting_date' => '2019-03-29 02:30:13',
            'ending_date' => '2019-03-29 02:30:13',
            'areas_affected' => '',
            'regions_affected' => '',
            'date' => '2019-03-29'
        ],
    ];
}
