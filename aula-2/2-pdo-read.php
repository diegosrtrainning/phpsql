<?php
require 'db.php';

try
{
    $db = conectar();

    $sql= "SELECT * FROM categoria";
    $categorias = read($db, $sql);        
    
    foreach($categorias as $categoria) {
        var_dump($categoria);
    }
    
}
catch(PDOException $e)
{
    echo "Error:".$e->getMessage();
}