<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocumentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocumentsTable Test Case
 */
class DocumentsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.documents',
        'app.users',
        'app.genders',
        'app.roles',
        'app.course_allocations',
        'app.courses',
        'app.posts',
        'app.blogs',
        'app.comments',
        'app.messages',
        'app.minutes',
        'app.meetings',
        'app.files',
        'app.attachments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Documents') ? [] : ['className' => 'App\Model\Table\DocumentsTable'];
        $this->Documents = TableRegistry::get('Documents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Documents);

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
