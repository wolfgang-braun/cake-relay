<?php
namespace App\Controller;

use App\Lib\Status;
use WolfgangBraun\PiRelay\PiRelay;
use CakeWebsocket\Lib\SocketPublisher;


class ChannelsController extends AppController
{
    /**
     * PiRelay instance
     *
     * @var PiRelay
     */
    public $PiRelay = null;

    /**
     * beforeFilter event
     *
     * @param Event $event cake event
     * @return void
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->PiRelay = new PiRelay(null, null, 0);
        $this->PiRelay->setSSHconfig('192.168.178.32', 'relay', '/Users/fuco/id_rsa');
        parent::beforeFilter($event);
    }

    public function index()
    {
        $this->loadModel('ChannelActions');
        $actionOn = $this->ChannelActions->newEntity();
        $this->set(compact('states'));
    }

    public function listLastActions()
    {
        $this->loadModel('App.ChannelActions');
        $actions = $this->ChannelActions->find()
            ->limit(10)
            ->contain('Users')
            ->order('ChannelActions.created DESC')
            ->toArray();
        $this->set(compact('actions'));
        return $this->render('/Element/Channels/channel_action_list', 'ajax');

        return $this->render();
    }

    public function setState($channel, $state)
    {
        $this->PiRelay->setState($channel, $state);
        $this->redirect(['action' => 'index']);
    }
}
