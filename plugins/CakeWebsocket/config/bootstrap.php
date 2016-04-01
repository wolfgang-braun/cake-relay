<?php
use Cake\Core\Configure;
use Cake\Utility\Hash;

// Load and merge default with app config
$config = include 'cake_websocket.default.php';
$config = $config['CakeWebsocket'];
if ($appCakeWebsocketConfig = Configure::read('CakeWebsocket')) {
    $config = Hash::merge($config, $appCakeWebsocketConfig);
}
Configure::write('CakeWebsocket', $config);
