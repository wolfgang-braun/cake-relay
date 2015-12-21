<?php
namespace App\Controller;

use App\Lib\Status;
use WolfgangBraun\PiRelay\PiRelay;
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
        $this->PiRelay = new PiRelay();
        parent::beforeFilter($event);
    }

    public function index()
    {
        $states = $this->PiRelay->getState();
        $this->set(compact('states'));
    }

    public function setState($channel, $state)
    {
        $this->PiRelay->setState($channel, $state);
        $this->redirect(['action' => 'index']);
    }
}