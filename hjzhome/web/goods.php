<?php

/**
 *  原商城改为"mall.hjzhome.com", 为兼容房点科技的效果图, 做 301 重定向到商城新地址
 */
$host = "mall.hjzhome.com";
$path = $_SERVER['REQUEST_URI'];
//if (strpos($path,'mobile') !== false){
    header('HTTP/1.1 301 Moved Permanently');//发出301头部
    header('Location:http://'.$host.$path);die;
//}