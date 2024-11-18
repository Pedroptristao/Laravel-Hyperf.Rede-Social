<?php
declare(strict_types=1);

namespace App\Controller;

use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;
use Swoole\Http\Request;

class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    private array $clients = [];

    public function onMessage($server, $frame): void
    {
        $message = json_decode($frame->data, true);
        $message['sender'] = $this->clients[$frame->fd];

        foreach ($this->clients as $fd => $client) {
            $server->push($fd, json_encode(['type' => 'message', 'sender' => $client, 'message' => $frame->data]));
        }
    }

    public function onClose($server, int $fd, int $reactorId): void
    {
        unset($this->clients[$fd]);
        $this->broadcastConnectedUsers($server);
    }

    public function onOpen($server, $request): void
    {
        $this->clients[$request->fd] = 'User ' . $request->fd;
        $this->broadcastConnectedUsers($server);
    }

    private function broadcastConnectedUsers(WebSocketServer $server): void
    {
        $connectedUsers = count($this->clients);
        foreach ($this->clients as $fd => $client) {
            $server->push($fd, json_encode(['type' => 'connectedUsers', 'count' => $connectedUsers]));
        }
    }
}

