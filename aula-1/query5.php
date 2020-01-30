<?php

$mysqli = new mysqli("127.0.0.1", "root", "", "trainning_ecom");

$sql = "
        UPDATE trainning_ecom.usuario
        SET
        nome = 'd2',
        sobrenome = 'sw',
        email = 'mudou@e.com',
        senha = '2345',
        ativoflag = 1,
        id_perfil = 1
        WHERE
        id = 1;";

$mysqli->query($sql);
echo $mysqli -> affected_rows;

$mysqli -> close();

?>