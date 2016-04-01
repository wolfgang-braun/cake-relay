<?php

namespace CakeWebsocket\Lib;

use CakeWebsocket\Lib\WebsocketTrait;

class WebsocketContent {

    use WebsocketTrait;

    protected $_content = null;
    protected $_conditionsCallback = null;

    public function __construct($content = null, $conditionsCallback)
    {
        $this->_content = $content;
        $this->_conditionsCallback = $conditionsCallback;
    }

    public function getPublisherClientIds($action = '')
    {
        $condtions = call_user_func_array($this->_conditionsCallback,[$action]);
        return $this->getSocketSessionIds($condtions);
    }

    public function getPublisherData()
    {
        return ['content' => $this->_content];
    }
}
