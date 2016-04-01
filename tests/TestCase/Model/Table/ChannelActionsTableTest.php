<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChannelActionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChannelActionsTable Test Case
 */
class ChannelActionsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.channel_actions',
        'app.users',
        'app.attachments',
        'app.model_history'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ChannelActions') ? [] : ['className' => 'App\Model\Table\ChannelActionsTable'];
        $this->ChannelActions = TableRegistry::get('ChannelActions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChannelActions);

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

    /**
     * Test onOff method
     *
     * @return void
     */
    public function testOnOff()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
