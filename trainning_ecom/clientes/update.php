<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {       
        $clientes = [];
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $confirmarSenha = $_POST["confirmarSenha"];

        if($id == 0){
            $id = rand(1, 10000);
        }

        $cliente = compact("id","nome", "sobrenome", "email", "senha");
        $clientesJson = file_get_contents(__DIR__."\\data\\clientes.json");

        if(!empty($clientesJson) && $clientesJson != "null"){
            $clientes = json_decode($clientesJson);                
        }
        
        array_push($clientes, $cliente);
        
        $myfile = fopen(__DIR__."\\data\\clientes.json", "w");
        fwrite($myfile, json_encode($clientes));                
        fclose($myfile);
                                        
        header("Location: /trainning/phpfoundation/bonus/bonus1/cadastro-endereco.php?id=$id");
        exit;
    }
?>