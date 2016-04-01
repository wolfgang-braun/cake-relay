<?php
namespace CakeWebsocket\Test\TestCase\Shell;

use CakeWebsocket\Shell\WebsocketServerShell;
use Cake\TestSuite\TestCase;

/**
 * CakeWebsocket\Shell\WebsocketServerShell Test Case
 */
class WebsocketServerShellTest extends TestCase
{

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \CakeWebsocket\Shell\WebsocketServerShell
     */
    public $WebsocketServer;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMock('Cake\Console\ConsoleIo');
        $this->WebsocketServer = new WebsocketServerShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WebsocketServer);

        parent::tearDown();
    }

    /**
     * Test getOptionParser method
     *
     * @return void
     */
    public function testGetOptionParser()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
