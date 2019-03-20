<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DocumentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\DocumentsController Test Case
 */
class DocumentsControllerTest extends IntegrationTestCase
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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
