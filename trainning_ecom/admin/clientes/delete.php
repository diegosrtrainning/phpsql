<?php
    include __DIR__ . "/../../libs/db.php";
    global $config;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {       
       $id = $_POST["id"];

        try {
            $db = conectar();
            
            $params = ["id_cliente" => $id];

            $sql = "DELETE FROM " . 
                    $config["DB_DATABASE"] . ".cliente" .
                    " WHERE id_cliente = :id_cliente";

            delete($db, $sql, $params);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            
        } catch (\Throwable $th) {
            //throw $th;
        }

       


    }
?>