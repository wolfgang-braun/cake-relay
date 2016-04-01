<?php
namespace CakeWebsocket\Test\TestCase\Model\Table;

use CakeWebsocket\Model\Table\CwsConnectionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * CakeWebsocket\Model\Table\CwsConnectionsTable Test Case
 */
class CwsConnectionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CakeWebsocket\Model\Table\CwsConnectionsTable
     */
    public $CwsConnections;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.cake_websocket.cws_connections',
        'plugin.cake_websocket.ressources',
        'plugin.cake_websocket.sessions',
        'plugin.cake_websocket.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CwsConnections') ? [] : ['className' => 'CakeWebsocket\Model\Table\CwsConnectionsTable'];
        $this->CwsConnections = TableRegistry::get('CwsConnections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CwsConnections);

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
