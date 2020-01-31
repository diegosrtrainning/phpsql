<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {         
    include __DIR__ . '/libs/config.php';

    session_start();
    // Limpando variáveis de sessão
    session_unset();

    // Destrindo a sessão 
    session_destroy();

    global $config;

    header("Location: ". $config["URL_PORTAL"]);    
}

?>