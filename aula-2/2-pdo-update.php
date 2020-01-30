<?php
require 'db.php';

try {
    $db = conectar();    
    $params = [
        'id_categoria' => 7,
        'nome' => 'dedededede'        
    ];

    $sql = "UPDATE categoria set nome=:nome where id_categoria=:id_categoria";    

    $id = update($db, $sql, $params);
    echo $id;
} catch( PDOExecption $e ) {
    print "Error!: " . $e->getMessage() . "</br>";
}
?>