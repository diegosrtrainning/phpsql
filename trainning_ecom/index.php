<?php
    require __DIR__. '/libs/db.php';
    $erro = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {         
        $email = $_POST["inputEmail"];
        $senha = $_POST["inputSenha"];

        try {
            $db = conectar();

            $sql = "select
                        id_cliente,
                        nome,
                        sobrenome,
                        email
                    from
                        trainning_ecom_oficial.cliente
                    where
                        email = '$email'
                        and senha = '$senha'
                        and ativo = 1";
            
            $clientes = read($db, $sql);

            if(!empty($clientes)){                
                session_start();
                $_SESSION["nommeUsuario"] = $clientes[0]->nome;
                header("Location: vitrine.php");
                exit;
            } else {
                $erro = "Email e/ou senha inválido(s)";
            }

        } catch (\Throwable $th) {
            //throw $th;
        }        

    }
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">        
    <title>Bonus 1 - Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>

<body class="text-center">    
    <form method="post" action="<?php $_SERVER["PHP_SELF"]?>" class="form-signin">
        <img class="mb-4" src="media/logo.png" alt="" width="200">
        <h1 class="h3 mb-3 font-weight-normal">Autenticação</h1>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required autofocus value="">
        <label for="inputSenha" class="sr-only">Senha</label>
        <input type="password" id="inputSenha" name="inputSenha" class="form-control" placeholder="Senha" required>
        <span class="erro"><?php echo $erro; ?></span>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="lembrememe"> Lembre-me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>        
        <a href="admin">Sou funcionário</a>
        <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
</body>

</html>