<?php
require 'db.php';

try {
    $db = conectar();    
    $sql = "INSERT INTO categoria (nome) VALUES(?)";
    $params = ["teste"];

    $id = create($db, $sql, $params);
    echo $id;
} catch( PDOExecption $e ) {
    print "Error!: " . $e->getMessage() . "</br>";
}
?>