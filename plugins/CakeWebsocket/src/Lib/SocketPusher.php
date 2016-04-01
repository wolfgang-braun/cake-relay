<?php
namespace CakeWebsocket\Lib;

use Cake\Network\Session\DatabaseSession;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;


class SocketPusher implements WampServerInterface {

    protected $_connections = [];

    public function __construct()
    {
        $this->CwsConnections = TableRegistry::get('CakeWebsocket.CwsConnections');
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->_connections[$conn->wrappedConn->WAMP->sessionId] = $conn;
        $sessionId = $this->__getSessionId($conn);
        $userId = $this->__getUserIdFromSession($sessionId);
        $this->CwsConnections->add($conn, $sessionId, $userId);
    }
    public function onClose(ConnectionInterface $conn) {
        unset($this->_connections[$conn->wrappedConn->WAMP->sessionId]);
        $this->CwsConnections->remove($conn);
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
        unset($this->_connections[$conn->wrappedConn->WAMP->sessionId]);
        $this->CwsConnections->remove($conn);
    }

    /**
     * @param string JSON'ified string we'll receive from ZeroMQ
     */
    public function onMessage($payload) {
        $payload = json_decode($payload, true);
        foreach ($payload['clients'] as $clientId) {
            if (empty($this->_connections[$clientId])) {
                continue;
            }
            $data = [
                'passed' => $payload['passed'],
                'action' => $payload['action'],
                'class_data' => $payload['class_data']
            ];
            $this->_connections[$clientId]->send(json_encode($data));
        }
    }

    private function __getSessionId($conn)
    {
        return $conn->WebSocket->request->getCookies()['CAKERELAY'];
    }

    private function __getUserIdFromSession($sessionId) {
        $dbs = new DatabaseSession();
        $sessionData = $dbs->read($sessionId);
        $unserializedData = [];
        $offset = 0;
        while ($offset < strlen($sessionData)) {
            if (!strstr(substr($sessionData, $offset), "|")) {
                throw new \Exception("invalid data, remaining: " . substr($sessionData, $offset));
            }
            $pos = strpos($sessionData, "|", $offset);
            $num = $pos - $offset;
            $varname = substr($sessionData, $offset, $num);
            $offset += $num + 1;
            $data = unserialize(substr($sessionData, $offset));
            $unserializedData[$varname] = $data;
            $offset += strlen(serialize($data));
        }
        return !empty($unserializedData['Auth']['User']['id']) ? $unserializedData['Auth']['User']['id'] : null;
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        $conn->close();
    }
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        $conn->close();
    }
    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
        $conn->close();
    }
    public function onSubscribe(ConnectionInterface $conn, $topic) {
        $conn->close();
    }
}
