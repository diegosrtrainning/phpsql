<?php

include __DIR__ . '/config.php';
if(!isset($_SESSION)){session_start();}

if(empty($_SESSION["nommeUsuario"])){

    global $config;
    //header("Location: ". $config["URL_PORTAL"] ."/admin");    
}
?>