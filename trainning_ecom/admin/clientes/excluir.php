<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {       
        $id = $_POST["id"];

        $clientesJson = file_get_contents(__DIR__."\\data\\clientes.json");
        $clientes = json_decode($clientesJson);                
        
        foreach ($clientes as $key => $cliente) {
            if($cliente->id == $id){
                unset($clientes[$key]);
                $clientes = array_values($clientes);

                $myfile = fopen(__DIR__."\\data\\clientes.json", "w");
                fwrite($myfile, json_encode($clientes));                
                fclose($myfile);

                break;
            }            
        }                                
        
        header("Location: /trainning/phpfoundation/bonus/bonus1/clientes.php");
        exit;
    }
?>