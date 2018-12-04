<?php
/**
 * Created by PhpStorm.
 * User: roger
 * Date: 18/10/29
 * Time: 下午8:59
 */
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

//日志记录
function logs($content){
    file_put_contents("./swoole.log", date("Y-m-d H:i:s").PHP_EOL. $content .PHP_EOL.PHP_EOL,FILE_APPEND);
}