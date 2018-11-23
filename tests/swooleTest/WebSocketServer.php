<?php
require "../public.php";

$server = new swoole_websocket_server("0.0.0.0", 9501);

$server->on('open', function (swoole_websocket_server $server, $request) {
    echo "server: handshake success with fd{$request->fd}\n";
    //p($server);
});

$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    /**
     * 接收client数据, 处理业务逻辑
     */
    $server->push($frame->fd, "this is server");
});

$server->on('request', function (swoole_http_request $request, swoole_http_response $response) {
    global $server;//调用外部的server
    // $server->connections 遍历所有websocket连接用户的fd，给所有用户推送
    foreach ($server->connections as $fd) {
        $server->push($fd, $request->get['message']);
    }
});

$server->on('close', function ($server, $fd) {
    //p($server);p($fd);
    $server->push($fd, "client {$fd} closed\n");
    echo "client {$fd} closed\n";
});

$server->start();










