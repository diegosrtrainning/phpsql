<?php

$mysqli = new mysqli("127.0.0.1", "root", "", "trainning_ecom");

$sql = "SELECT nome, sobrenome FROM usuario";
$result = $mysqli->query($sql);

// Associative array
$row = $result -> fetch_array(MYSQLI_ASSOC);
echo $row["nome"], $row["sobrenome"];

$mysqli -> close();

?>