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
                Produtos
            </div>            
        </div>          
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <!-- TODO: Criar Header -->
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                     //TODO Listar Produtos                    
                    ?>                                            
            </tbody>
            </table>

    </div>    
</body>

</html>