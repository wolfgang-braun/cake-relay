<?php
use Cake\Routing\Router;

Router::plugin(
    'CakeWebsocket',
    ['path' => '/cake-websocket'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
