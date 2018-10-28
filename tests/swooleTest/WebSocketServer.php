<?php
function p($var,$is_die=0,$is_gbk=0)
{
    if (is_bool($var)) {
        var_dump($var);
    } else if (is_null($var)) {
        var_dump(NULL);
    } else {
        $is_cli = preg_match("/cli/i", php_sapi_name()) ? true : false;
        if (!$is_cli){
            echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
        }else{
            if($is_gbk) $var = iconv("utf-8","gbk",$var);
            echo print_r($var, true);
        }
    }
    if ($is_die==1) die;
}



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

$server->on('close', function ($server, $fd) {
    //p($server);p($fd);
    $server->push($fd, "client {$fd} closed\n");
    echo "client {$fd} closed\n";
});

$server->start();










