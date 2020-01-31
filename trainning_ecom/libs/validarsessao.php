<?php

include __DIR__ . '/config.php';
session_start();

if(empty($_SESSION["nommeUsuario"])){

    global $config;
    header("Location: ". $config["URL_PORTAL"] ."/admin");    
}
?>