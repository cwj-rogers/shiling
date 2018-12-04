<?php
$host = "hjzhome.com";
$path = $_SERVER['REQUEST_URI'];
if (strpos($path,'mobile') !== false){
    header('Location:http://'.$host);die;
}