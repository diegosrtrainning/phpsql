<?php

$mysqli = new mysqli("127.0.0.1", "root", "", "trainning_ecom");

$sql = "SELECT nome, sobrenome, ativoFlag FROM usuario";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
    echo 'Nome: '.$row['nome'].' '.$row['sobrenome'].'<br>';
    echo 'Ativo: '.$row['ativoFlag'].'<br>'; 
}

$mysqli -> close();

?>