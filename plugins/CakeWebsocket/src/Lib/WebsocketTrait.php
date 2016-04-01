<?php

namespace CakeWebsocket\Lib;

use Cake\ORM\TableRegistry;

trait WebsocketTrait
{

    public function getPublisherClientIds($action = '')
    {
        return [];
    }

    public function getPublisherData($action = '')
    {
        return [];
    }

    public function getSocketSessionIds($conditions = [])
    {
        return array_values(TableRegistry::get('CakeWebsocket.CwsConnections')
            ->find('list')
            ->contain(['Users'])
            ->where($conditions)
            ->toArray());
    }

    public function getPayloadAction($action)
    {
        return join('', array_slice(explode('\\', get_class()), -1)) . '.' . $action;
    }
}
