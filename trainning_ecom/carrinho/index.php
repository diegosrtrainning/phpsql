<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">        
    <title>Trainning - Ecom</title>

    <!-- Bootstrap core CSS -->            
    <link href="../css/main.css" rel="stylesheet">    
    <link href="../css/carrinho.css" rel="stylesheet">    
</head>

<body class="">
    <!-- TOPO DA PAGINA -->        
    <?php include __DIR__ . "/../libs/topo.php"; ?>
    <div id="container" class="container">                                            
        <div class="row title-section">
            <div class="col-12">
                Meu Carrinho
            </div>            
        </div>                  
        <?php            
            include __DIR__ . "/../libs/db.php";
            global $config;
            $carrinho = [];            
            if(!empty($_COOKIE["carrinho"]))
            {
                $carrinho = json_decode($_COOKIE["carrinho"]);
            } 

            if(count($carrinho) > 0)
            {
                $produtos = implode(',', $carrinho);
                    
                $db = conectar();
                $sql = "SELECT
                            p.id_produto,
                            p.nome,
                            p.descricao,
                            p.valor,
                            p.ativo,
                            p.foto_vitrine,
                            c.nome as 'categoria'
                        FROM
                            trainning_ecom_oficial.produto p
                            INNER JOIN trainning_ecom_oficial.CATEGORIA c ON p.ID_CATEGORIA = c.ID_CATEGORIA                        
                        WHERE 
                            p.ID_PRODUTO IN ($produtos);";
                
                $produtos_carrinho = read($db, $sql);                    

                foreach ($produtos_carrinho as $key => $produto) {
                    echo  "<div class='row'>".
                                "<div class='col-2'>".
                                    "<img class='img-carrinho' src='" . $config["URL_PORTAL"] . "/" . $produto['foto_vitrine'] ."'/>".
                                "</div>".            
                                "<div class='col-4 produto-carrinho-container'>".
                                "<h2>" . $produto['nome'] . "</h2>" .
                                "<p>" . $produto['descricao'] . "</p>" .
                                "<p> R$ " . $produto['valor'] . "</p>" .
                                "<p> <input type='number' name='quantidade' min='1' max='100' value='1' /></p>" .
                                "</div>".
                            "</div>";
                }
            } else {
                echo "Seu carrinho está vazio :(";
            }
            ?>
        </div>
    </div>    
</body>

</html>