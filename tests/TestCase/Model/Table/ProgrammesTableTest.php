<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProgrammesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProgrammesTable Test Case
 */
class ProgrammesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.programmes',
        'app.groups',
        'app.allocations',
        'app.areas',
        'app.locations',
        'app.regions',
        'app.schedules'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Programmes') ? [] : ['className' => 'App\Model\Table\ProgrammesTable'];
        $this->Programmes = TableRegistry::get('Programmes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Programmes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
