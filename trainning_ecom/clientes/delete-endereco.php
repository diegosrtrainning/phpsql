<?php
    include __DIR__ . "/../libs/db.php";
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {               
        $id = $_POST["id"];
        
        try {
            $db = conectar();
            
            $sql = "DELETE FROM cliente_endereco WHERE id_cliente_endereco = :id_cliente_endereco";
            $params = ["id_cliente_endereco" => $id];
            $rows = delete($db, $sql, $params);            
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;

        } catch (\Throwable $th) {
            //throw $th;
        }                                                
    }
?>