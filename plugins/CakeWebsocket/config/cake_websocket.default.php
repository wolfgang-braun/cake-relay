<?php
return [
    'CakeWebsocket' => [
        'ZMQ' => [
            'Shell' => [
                'host' => 'tcp://127.0.0.1:5555'
            ],
            'host' => 'tcp://localhost:5555'
        ],
        'Socket' => [
            'host' => '0.0.0.0',  // Binding to 0.0.0.0 means remotes can connect
            'port' => '8080'
        ]
    ]
];
