<?php
    $id = 0;
    $disabled = 'disabled';
    if(!empty($_GET["id"])){
        $id =  $_GET["id"];
        $disabled = '';
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
                Cadasto 1/3
            </div>
        </div>      
        
            <div class="row">
                <!-- Dados Pessoais -->
                <div class="col-6">
                    <form method="post" action="adicionar.php" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">            
                        <div class="row">
                            <div class="col-12 form-fields">
                                <div class="form-group row">
                                    <label for="nome" class="col-sm-4 col-form-label col-form-label-lg text-right">Nome:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg" id="nome" name="nome" placeholder="Digite o nome" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sobrenome" class="col-sm-4 col-form-label col-form-label-lg text-right">Sobrenome:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cpf" class="col-sm-4 col-form-label col-form-label-lg text-right">CPF:</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg" id="cpf" name="cpf" placeholder="Digite o CPF" maxlength="15" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label col-form-label-lg text-right">Email:</label>
                                    <div class="col-sm-8">
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email" required>
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
                </div>

                <!-- Imagem -->
                <div class="col-6 text-center">                
                    <form method="post" action="salvar-foto.php" enctype="multipart/form-data">
                        <input id="id" name="id" value="<?php echo $id; ?>" type="hidden">            
                        <div class="row">
                            <div class="col-12">
                                <img class="img-user" src="../media/user.png" alt="">
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
                                <input type="submit" class="btn btn-success" value="Salvar" />
                            </div>
                        </div>                    
                    </form>
                </div>                
            </div>                                                     
    </div>    
</body>

</html>