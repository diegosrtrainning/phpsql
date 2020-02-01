<?php
include __DIR__ . '/config.php';

if(!isset($_COOKIE["PHPSESSID"]))
{
    session_start();
}

if(empty($_SESSION["nomeCliente"])){
    global $config;

    //header("Location: ". $config["URL_PORTAL"]);
}
?>