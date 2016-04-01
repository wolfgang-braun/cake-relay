<?php
namespace CakeWebsocket\Controller;

use CakeWebsocket\Controller\AppController;
use CakeWebsocket\Lib\SocketPublisher;
use CakeWebsocket\Lib\WebsocketContent;

/**
 * Example Controller
 *
 * @property \CakeWebsocket\Model\Table\ExampleTable $Example
 */
class ExampleController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $websocketContent = new WebsocketContent('class related information', function($action) {
            if ($action == 'somethingHappened') {
                return ['Users.id is not null'];
            }
            return [];
        });
        (new SocketPublisher($websocketContent, 'somethingHappened', ['additional' => 'info']))->send();
    }
}
