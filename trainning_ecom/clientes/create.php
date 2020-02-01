<?php
    include __DIR__ . "/../libs/db.php";
    include __DIR__ . "/../libs/utils/datetime.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {       
        $clientes = [];
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $cpf = $_POST["cpf"];
        $data_nascimento = dateParse($_POST["data_nascimento"]);
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $ativo = 1;
        $confirmarSenha = $_POST["confirmarSenha"];

        $params = compact('nome', 'sobrenome', 'email', 'senha', 'ativo','cpf', 'data_nascimento');
        //$params = [$nome, $sobrenome, $email, $senha, $ativo, $cpf, $data_nascimento]; (com ?,?,?,?,?,?,?)
        
        try {
            $db = conectar();
            
            $sql = "insert
            into
                trainning_ecom_oficial.cliente (
                nome,
                sobrenome,
                email,
                senha,
                ativo,
                cpf,
                data_nascimento)
            values(:nome,:sobrenome,:email,:senha,:ativo,:cpf,:data_nascimento)";
            
            $id = create($db, $sql, $params);

            $_SESSION["idCliente"] = $id;
            $_SESSION["nomeCliente"] = $nome;

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;

        } catch (\Throwable $th) {
            //throw $th;
        }                                                
    }
?>