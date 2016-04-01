<?php
namespace CakeWebsocket\Lib;

use Cake\Core\Configure;
use \ZMQ;
use \ZMQContext;

class SocketPublisher
{

    protected $_class = null;
    protected $_payload = [];
    protected $_clients = [];
    protected $_action = '';

    public function __construct($class, $action, $additionalPayload = [])
    {
        $this->_setClass($class);
        $this->_setAction($action);
        $this->_setPayload(['passed' => $additionalPayload]);
        $this->_setClients();
    }

    protected function _setClass($class)
    {
        $this->_class = $class;
    }

    protected function _setPayload($data)
    {
        $this->_payload += $data;
    }

    protected function _setAction($action)
    {
        $this->_action = $action;
    }

    protected function _setClients()
    {
        $this->_clients = $this->_class->getPublisherClientIds($this->_action);
    }

    public function send()
    {
        if (empty($this->_clients)) {
            return;
        }

        $this->_setPayload(['class_data' => $this->_class->getPublisherData($this->_action)]);
        $this->_setPayload(['clients' => $this->_clients]);
        $this->_setPayload(['action' => $this->_class->getPayloadAction($this->_action)]);

        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, $this->_class->getPayloadAction($this->_action));
        $socket->connect(Configure::read('CakeWebsocket.ZMQ.host'));
        $socket->send(json_encode($this->_payload));
    }
}
