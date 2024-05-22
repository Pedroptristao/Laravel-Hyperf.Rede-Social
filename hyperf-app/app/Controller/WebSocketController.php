<?php
declare(strict_types=1);

namespace App\Controller;

use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;

class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    private $clients = [];

    public function onMessage($server, $frame): void
    {
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
        if (!isset($this->clients[$request->fd])) {
            $this->clients[$request->fd] = $request->fd;
            $this->broadcastConnectedUsers($server);
        }
    }
    

    private function broadcastConnectedUsers($server)
    {
        $connectedUsers = count($this->clients);
        foreach ($this->clients as $fd => $client) {
            $server->push($fd, json_encode(['type' => 'connectedUsers', 'count' => $connectedUsers]));
        }
    }
}
