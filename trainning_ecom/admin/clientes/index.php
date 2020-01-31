<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">        
    <title>Bonus 1 - Esqueleto</title>

    <!-- Bootstrap core CSS -->            
    <link href="../../css/main.css" rel="stylesheet">    
    <link href="../../css/cadastro.css" rel="stylesheet">    
</head>

<body class="">
    <!-- TOPO DA PAGINA -->        
    <?php include __DIR__ . "/../../libs/topo-admin.php"; ?>
    <div id="container" class="container">                            

        <div class="row">
            <div class="col-11">
                Filtros
            </div>
        </div>
        <form>
            <div class="row">
                <div class="col-12">
                    <div class="form-row">
                        <div class="col-4">
                            <input type="text" class="form-control" placeholder="Nome">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Cpf">
                        </div>                
                        <div class="col">
                        <input type="submit" class="btn btn-primary" value="Filtrar"/>
                        </div>                                    
                </div>              
                </div>            
        </form>            
        
        <div class="row title-section">
            <div class="col-12">
                Clientes
            </div>            
        </div>          
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Sobrenome</th>
                <th scope="col">CPF</th>
                <th scope="col">Data Nascimento</th>
                <th scope="col">Ativo</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                    <?php

                    include __DIR__ . "/../../libs/db.php";

                    $db = conectar();
                    $sql = "SELECT
                                id_cliente,
                                nome,
                                sobrenome,
                                data_nascimento,
                                email,
                                senha,
                                ativo,
                                cpf
                            FROM
                                trainning_ecom_oficial.cliente;
                                WHERE ativo = 1";
                    $clientes = read($db, $sql);                    
                    
                    foreach ($clientes as $key => $cliente) {
                        echo  "<tr>".
                                    "<td scope='row'>" . $cliente['id_cliente'] ."</td>" .
                                    "<td>" . $cliente['nome'] ."</td>".
                                    "<td>" . $cliente['sobrenome'] ."</td>".                                        
                                    "<td>" . $cliente['cpf'] ."</td>".
                                    "<td>" . $cliente['data_nascimento'] ."</td>".
                                    "<td>" . ($cliente['ativo'] == 1 ? "Sim" : "Não") ."</td>".
                                    "<td>".
                                        "<form style='display: inline; padding-right: 20px' action='delete.php' method='post'>" .
                                            "<input type='hidden' name='id' value='" . $cliente['id_cliente'] ."' />".
                                            "<input type='submit' class='btn btn-danger' value='Deletar' />".
                                        "</form>".                    
                                    "</td>".
                                "</tr>";
                        }                    
                    ?>
            </tbody>
        </table>
    </div>    
</body>

</html>