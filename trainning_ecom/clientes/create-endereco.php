<?php
    include __DIR__ . "/../libs/db.php";
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {               
        $id = $_POST["id"];
        $cep = $_POST["cep"];
        $logradouro = $_POST["logradouro"];
        $numero = $_POST["numero"];
        $complemento = $_POST["complemento"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];                

        try {
            $sql = "";
            $db = conectar();

            session_start();                        

            if($id == 0){   
                $params = [                    
                    "cep" => $cep, 
                    "logradouro" => $logradouro, 
                    "numero" =>  $numero, 
                    "complemento" => $complemento, 
                    "bairro" => $complemento, 
                    "cidade" => $cidade, 
                    "estado" => $estado,
                    "id_cliente" => $_SESSION["idCliente"] 
                ];

                $sql = "INSERT INTO trainning_ecom_oficial.cliente_endereco
                    (cep, logradouro, numero, complemento, bairro, cidade, estado, id_cliente)
                VALUES(:cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, :id_cliente)";

                $id = create($db, $sql, $params);            
            } else{
                $params = [                    
                    "id_cliente_endereco" => $id,
                    "cep" => $cep, 
                    "logradouro" => $logradouro, 
                    "numero" =>  $numero, 
                    "complemento" => $complemento, 
                    "bairro" => $complemento, 
                    "cidade" => $cidade, 
                    "estado" => $estado,
                    "id_cliente" => $_SESSION["idCliente"] 
            ]   ;

                $sql = "UPDATE trainning_ecom_oficial.cliente_endereco
                    SET cep=:cep, logradouro=:logradouro, numero=:numero, complemento=:complemento, bairro=:bairro, cidade=:cidade, estado=:estado, id_cliente=:id_cliente
                    WHERE id_cliente_endereco=:id_cliente_endereco";                

                $id = update($db, $sql, $params);            
            }

            header('Location: ' . $config["URL_PORTAL"] . "/clientes");
            exit;

        } catch (\Throwable $th) {
            //throw $th;
        }                                                
    }
?>