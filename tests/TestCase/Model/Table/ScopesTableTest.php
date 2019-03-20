<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScopesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScopesTable Test Case
 */
class ScopesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.scopes',
        'app.modules',
        'app.users',
        'app.genders',
        'app.roles',
        'app.account_permissions',
        'app.course_allocations',
        'app.courses',
        'app.posts',
        'app.blogs',
        'app.comments',
        'app.messages',
        'app.minutes',
        'app.meetings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Scopes') ? [] : ['className' => 'App\Model\Table\ScopesTable'];
        $this->Scopes = TableRegistry::get('Scopes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scopes);

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
