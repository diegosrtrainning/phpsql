<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {         

    session_start();
    // Limpando variáveis de sessão
    session_unset();

    // Destrindo a sessão 
    session_destroy();

    header("Location: Login.php");
}

?>