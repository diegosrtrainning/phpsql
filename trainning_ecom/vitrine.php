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
        <?php include __DIR__ . "/includes/topo.php"; ?>
        <?php include __DIR__ . "/includes/vitrine/item.php"; ?>
        
        <div id="container" class="container">
            <?php
                $produtosJson = file_get_contents(__DIR__."\\data\\produtos.json");
                $produtos = json_decode($produtosJson);

                echo '<div class="row card-container">';

                foreach ($produtos as $key => $produto) {                      
                    if($key%3 == 0){
                        echo '</div><div class="row card-container">';
                    }
                    
                    echo criarItem($produto);                                        
                }                

                echo '</div>';
                
            ?>                                        
        </div>
</body>

</html>