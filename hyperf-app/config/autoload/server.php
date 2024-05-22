<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\Server\Server;
use Hyperf\Server\Event;

return [
    'mode'      => SWOOLE_PROCESS,
    'servers'   => [
        [
            'name'      => 'http',
            'type'      => Server::SERVER_HTTP,
            'host'      => '0.0.0.0',
            'port'      => 9501,
            'sock_type' => SWOOLE_SOCK_TCP,
            'callbacks' => [
                Event::ON_REQUEST => [Hyperf\HttpServer\Server::class, 'onRequest'],
            ],
        ],
        [
            'name'      => 'ws',
            'type'      => Server::SERVER_WEBSOCKET,
            'host'      => '0.0.0.0',
            'port'      => 9502,
            'sock_type' => SWOOLE_SOCK_TCP,
            'callbacks' => [
                Event::ON_HAND_SHAKE => [Hyperf\WebSocketServer\Server::class, 'onHandShake'],
                Event::ON_MESSAGE    => [Hyperf\WebSocketServer\Server::class, 'onMessage'],
                Event::ON_CLOSE      => [Hyperf\WebSocketServer\Server::class, 'onClose'],
            ],
            'settings'  => [
                'heartbeat_idle_time'      => 70,
                'heartbeat_check_interval' => 30,
            ]
        ],
    ],
    'settings'  => [
        'enable_coroutine'      => true,
        'worker_num'            => swoole_cpu_num(),
        'task_worker_num'       => swoole_cpu_num(),
        'task_enable_coroutine' => false,
        'pid_file'              => BASE_PATH . '/runtime/hyperf.pid',
        'open_tcp_nodelay'      => true,
        'max_coroutine'         => 100000,
        'open_http2_protocol'   => true,
        'max_request'           => 100000,
        'socket_buffer_size'    => 2 * 1024 * 1024,
        'buffer_output_size'    => 2 * 1024 * 1024,
        'document_root'         => BASE_PATH . '/public',
        'enable_static_handler' => true,
    ],
    'callbacks' => [
        Event::ON_BEFORE_START => [Hyperf\Framework\Bootstrap\ServerStartCallback::class, 'beforeStart'],
        Event::ON_WORKER_START => [Hyperf\Framework\Bootstrap\WorkerStartCallback::class, 'onWorkerStart'],
        Event::ON_PIPE_MESSAGE => [Hyperf\Framework\Bootstrap\PipeMessageCallback::class, 'onPipeMessage'],
        Event::ON_TASK         => [Hyperf\Framework\Bootstrap\TaskCallback::class, 'onTask'],
        Event::ON_FINISH       => [Hyperf\Framework\Bootstrap\FinishCallback::class, 'onFinish'],
    ],
];