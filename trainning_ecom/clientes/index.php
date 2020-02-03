<?php
    include __DIR__ .'/../libs/db.php';
    global $config;
    $id = 0;
    $nome = $sobrenome = $cpf = $data_nascimento = $email = "";
    $foto = "../media/user.png";
    $disabled = 'disabled';
    session_start();
    error_reporting(0);

    if(!empty($_SESSION["idCliente"])){
        $id =  $_SESSION["idCliente"];

        $db = conectar();

        $sql = "SELECT
                    id_cliente,
                    nome,
                    sobrenome,
                    data_nascimento,
                    email,
                    senha,
                    ativo,
                    cpf,
                    foto
                FROM
                    trainning_ecom_oficial.cliente;
                    WHERE id_cliente = $id";
        
        $enderecos = read($db, $sql);                    
        
        if(isset($enderecos)){
            $nome = $enderecos[0]["nome"];
            $sobrenome = $enderecos[0]["sobrenome"];
            $cpf = $enderecos[0]["cpf"];
            $data_nascimento = $enderecos[0]["data_nascimento"];
            $email = $enderecos[0]["email"];
            $foto = $config["URL_PORTAL"] . "/" . $enderecos[0]["foto"];
            $disabled = '';
        }        
    }
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">        
    <title>Bonus 1 - Esqueleto</title>

    <!-- Bootstrap core CSS -->            
    <link href="../css/main.css" rel="stylesheet">    
    <link href="../css/cadastro.css" rel="stylesheet">    
</head>

<body class="">
    <!-- TOPO DA PAGINA -->        
    <?php include __DIR__ . "/../libs/topo.php"; ?>
    <div id="container" class="container">                            
        <div class="row">
            <div class="col-12">
                Dados Pessoais
            </div>
        </div>      
        
            <div class="row">
                <!-- Dados Pessoais -->
                <div class="col-6">
                    <form method="post" action="create.php" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">            
                        <div class="row">
                            <div class="col-12 form-fields">
                                <div class="form-group row">
                                    <label for="nome" class="col-sm-4 col-form-label col-form-label-lg text-right">Nome:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg" id="nome" name="nome" placeholder="Digite o nome" value="<?php echo $nome; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sobrenome" class="col-sm-4 col-form-label col-form-label-lg text-right">Sobrenome:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg" id="sobrenome" name="sobrenome" placeholder="Sobrenome" " value="<?php echo $sobrenome; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cpf" class="col-sm-4 col-form-label col-form-label-lg text-right">CPF:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg" id="cpf" name="cpf" placeholder="Digite o CPF" maxlength="15" value="<?php echo $cpf; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="data_nascimento" class="col-sm-4 col-form-label col-form-label-lg text-right">Data nascimento:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg" id="data_nascimento" name="data_nascimento" placeholder="Digite a data de nascimento" maxlength="15" value="<?php echo $data_nascimento; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label col-form-label-lg text-right">Email:</label>
                                    <div class="col-sm-8">
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="senha" class="col-sm-4 col-form-label col-form-label-lg text-right">Senha:</label>
                                    <div class="col-sm-8">
                                    <input type="password" class="form-control form-control-lg" id="senha" name="senha" placeholder="Senha" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmarSenha" class="col-4 col-form-label col-form-label-lg text-right">Confirmar senha:</label>
                                    <div class="col-sm-8">
                                    <input type="password" class="form-control form-control-lg" id="confirmarSenha" name="confirmarSenha" placeholder="Confirmar senha" required>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="row justify-content-md-center form-buttons" >                                        
                            <div class="col-1">
                                <input type="submit" class="btn btn-success" value="Salvar" />
                            </div>
                        </div>                            
                    </form>     
                    <div class="row title-section">
                        <div class="col-11">
                            Endereços
                        </div>            
                        <div class="col-1">
                            <a href="enderecos.php" class="btn btn-success">Novo</a>
                        </div>            
                    </div>          
                    <div class="row">
                        <div class="col-12">                    
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Endereço</th>                                    
                                    <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php                                        

                                        $db = conectar();
                                        $sql = "SELECT                                                    
                                                    ce.id_cliente_endereco AS 'id',
                                                    concat(ce.logradouro, ', ', ce.NUMERO, case ifnull(ce.COMPLEMENTO, '') when '' then '' else concat(' - ', ce.COMPLEMENTO) end, ' - ', ce.CIDADE, '-', ce.ESTADO) AS 'endereco'
                                                FROM
                                                    trainning_ecom_oficial.CLIENTE_ENDERECO ce
                                                    WHERE ID_CLIENTE = " . $_SESSION["idCliente"];

                                        $enderecos = read($db, $sql);                    
                                        
                                        foreach ($enderecos as $key => $endereco) {
                                            echo  "<tr>".
                                                        "<td scope='row'>" . $endereco['id'] ."</td>" .
                                                        "<td>" . $endereco['endereco'] ."</td>".                                                        
                                                        "<td>".
                                                            "<a class='btn btn-primary btn-grid' href='enderecos.php?id=". $endereco['id'] ."'>Editar</a>&nbsp;&nbsp;".
                                                            "<form style='display: inline; padding-right: 20px' action='delete-endereco.php' method='post'>" .
                                                                "<input type='hidden' name='id' value='" . $endereco['id'] ."' />".
                                                                "<input type='submit' class='btn btn-danger btn-grid' value='Deletar' />".
                                                            "</form>".                    
                                                        "</td>".
                                                    "</tr>";
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>                       
                    </div>
                </div>

                <!-- Imagem -->
                <div class="col-6 text-center">                
                    <form method="post" action="create-foto.php" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">            
                        <div class="row">
                            <div class="col-12">
                                <img class="img-user" src="<?php echo $foto; ?>" alt="">
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-8">
                                <span class="span-foto">Selecione uma foto</span>
                                <div class="form-group">                                        
                                    <input type="file" class="form-control-file" id="foto" name="foto" <?php echo $disabled; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center form-buttons" >                                        
                            <div class="col-1">
                                <input type="submit" class="btn btn-success" value="Salvar" <?php echo $disabled; ?> />
                            </div>
                        </div>                    
                    </form>
                </div>                
            </div>                                                     
    </div>    
</body>

</html>