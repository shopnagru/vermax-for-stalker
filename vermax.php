<?php
/*
 * Обработчик запросов от приставки Vermax
 * Copyright (c) 2016 ООО "НАГ"
 * Developer: Ivan Slyusar xvanok@nag.ru
 */
require_once("vermax/actions/actions.class.php");
$vermax = new vermaxActions();

if(isset($_GET["type"])){
    $type = $_GET["type"];
    switch($type){
        case "config":
            $vermax->getConfig('config');
            break;
        case "update":
            $vermax->getConfig('update');
            break;
        case "setting":
            $vermax->getConfig('setting');
            break;
        case "firmware":
            $vermax->getConfig('firmware');
            break;
        case "event":
            $vermax->setEvent();
            break;
        case "message":
            $vermax->getMessage();
            break;
        case "m3u":
            $vermax->getM3U();
            break;
        default:
            return $vermax->getIndex();
            break;
    }
}
else{
    $vermax->getIndex();
}