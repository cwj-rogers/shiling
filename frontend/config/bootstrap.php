<?php
function wxlog($content){
    file_put_contents(dirname(dirname(__DIR__))."/wechat.log", $content."  ".date("Y-m-d H:i:s").PHP_EOL,FILE_APPEND);
}