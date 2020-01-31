<?php
include __DIR__ . '/config.php';

session_start();
if(empty($_SESSION["nomeCliente"])){
    global $config;

    //header("Location: ". $config["URL_PORTAL"]);
}
?>