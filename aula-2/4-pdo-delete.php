<?php
require 'db.php';

try {
    $db = conectar();    
    $params = [
        'id_categoria' => 1        
    ];

    $sql = "DELETE FROM categoria where id_categoria=:id_categoria";    

    $id = delete($db, $sql, $params);
    echo $id;
} catch( PDOExecption $e ) {
    print "Error!: " . $e->getMessage() . "</br>";
}
?>