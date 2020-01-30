<?php 

$mysqli = new mysqli("127.0.0.1", "root", "", "trainning_ecom");

if ($mysqli-> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit;
}

$mysqli-> query('SELECT * FROM usuario');
echo "Affected rows: " . $mysqli -> affected_rows;

$mysqli -> close();
?>