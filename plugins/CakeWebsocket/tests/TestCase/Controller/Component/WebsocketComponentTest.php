<?php
namespace CakeWebsocket\Test\TestCase\Controller\Component;

use CakeWebsocket\Controller\Component\WebsocketComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * CakeWebsocket\Controller\Component\WebsocketComponent Test Case
 */
class WebsocketComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CakeWebsocket\Controller\Component\WebsocketComponent
     */
    public $Websocket;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Websocket = new WebsocketComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Websocket);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
