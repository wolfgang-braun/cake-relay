<?php
namespace CakeWebsocket\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use CakeWebsocket\Lib\SocketPusher;
use React\EventLoop\Factory;
use React\Socket\Server;
use React\ZMQ\Context;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Wamp\WampServer;
use \ZMQ;

/**
 * WebsocketServer shell command.
 */
class WebsocketServerShell extends Shell
{
    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $loop   = Factory::create();
        $pusher = new SocketPusher;

        $context = new Context($loop);
        $pull = $context->getSocket(ZMQ::SOCKET_PULL);
        $pull->bind(Configure::read('CakeWebsocket.ZMQ.Shell.host'));
        $pull->on('message', array($pusher, 'onMessage'));

        $webSock = new Server($loop);
        $webSock->listen(Configure::read('CakeWebsocket.Socket.port'), Configure::read('CakeWebsocket.Socket.host'));
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WampServer(
                        $pusher
                    )
                )
            ),
            $webSock
        );

        $loop->run();
    }
}
