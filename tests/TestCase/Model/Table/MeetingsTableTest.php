<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MeetingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MeetingsTable Test Case
 */
class MeetingsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.meetings',
        'app.users',
        'app.genders',
        'app.roles',
        'app.course_allocations',
        'app.courses',
        'app.posts',
        'app.blogs',
        'app.comments',
        'app.messages',
        'app.minutes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Meetings') ? [] : ['className' => 'App\Model\Table\MeetingsTable'];
        $this->Meetings = TableRegistry::get('Meetings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Meetings);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
