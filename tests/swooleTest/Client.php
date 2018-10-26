<?php
//创建socket客户端
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
//连接
$client->on("connect", function(swoole_client $cli) {
    $cli->send("GET / HTTP/1.1\r\n\r\n");
    //$cli->send("connect websocket");
});
//监听接收
$client->on("receive", function(swoole_client $cli, $data){
    echo "Receive: $data\n";
    $cli->send(str_repeat('A', 100)."\n");
    sleep(1);
});
//监听错误
$client->on("error", function(swoole_client $cli){
    echo "error\n";
});
//监听关闭
$client->on("close", function(swoole_client $cli){
    echo "Connection close\n";
});
//连接
$client->connect('0.0.0.0', 9501);