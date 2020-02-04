<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">        
    <title>Bonus 1 - Vitrine</title>

    <!-- Bootstrap core CSS -->            
    <link href="css/main.css" rel="stylesheet">
    <link href="css/vitrine.css" rel="stylesheet">
</head>

<body class="text-center">
    
        <!-- TOPO DA PAGINA -->
        <?php include __DIR__ . "/libs/topo.php"; ?>
        <?php include __DIR__ . "/libs/db.php"; ?>
        <?php include __DIR__ . "/carrinho/item.php"; ?>
        
        <div id="container" class="container">
            <?php
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
                            p.ativo = 1";
            
                $produtos = read($db, $sql);                    
            
                echo '<div class="row card-container">';

                $carrinho =[];
                if(!empty($_COOKIE["carrinho"]))
                {
                    $carrinho = json_decode($_COOKIE["carrinho"]);
                }                                                     

                foreach ($produtos as $key => $produto) {                      
                    if($key%3 == 0){
                        echo '</div><div class="row card-container">';
                    }
                    
                    $estaNoCarrinho = array_search($produto["id_produto"], array_column($carrinho, 'id_produto'));
                    $estaNoCarrinho = ($estaNoCarrinho !== false);

                    echo criarItem($produto, $estaNoCarrinho);
                }                

                echo '</div>';                
            ?>                                        
        </div>
</body>

</html>