<?php

$mysqli = new mysqli("127.0.0.1", "root", "", "trainning_ecom");

$sql = "SELECT nome, sobrenome FROM usuario";
$result = $mysqli->query($sql);

// Numeric array
$row = $result -> fetch_array(MYSQLI_NUM);
echo $row[0], $row[1];

$mysqli -> close();

?>