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

            $produtosArr = [];

            foreach ($carrinho as $key => $produto) {                
                array_push($produtosArr, $produto->id_produto);
            }                         
            
            if(count($carrinho) > 0)
            {
                $produtos = implode(',', $produtosArr);
                
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

                echo  "<div class='row'>".
                "<div class='col-9'>
                    <div class='row itens-titulo'>
                        <div class='col-2'>Foto</div>
                        <div class='col-3'>Item</div>
                        <div class='col-2'>Preço</div>
                        <div class='col-2'>Qtde.</div>
                        <div class='col-2'>Subtotal</div>
                    </div>";
                foreach ($produtos_carrinho as $key => $produto) {
                    $idFind = array_search($produto->id_produto, array_column($carrinho, 'id_produto'));        
                    $itemCarrinho = $carrinho[$idFind];                    

                    echo  "<div class='row item-container'>
                                <div class='col-2'>
                                    <img class='img-carrinho' src='" . $config["URL_PORTAL"] . "/" . $produto['foto_vitrine'] ."'/>
                                    <form method='post' action='delete.php'>
                                        <input type='hidden' name='id' value='" . $produto['id_produto'] . "' />                                        
                                        <p>
                                            <input type='submit' class='btn btn-danger btn-rmv-carrinho' value='Remover' />
                                        </p>
                                    </form>
                                </div>
                                <div class='col-3'>
                                    <p class='p-desc-item'>" . $produto['nome'] . "<br>" .
                                    $produto['descricao'] . "</p>
                                </div>
                                <div class='col-2'>
                                    <p> R$ " . $produto['valor'] . "</p>
                                </div>
                                <div class='col-2'>
                                    <form method='post' action='recalcular.php'>
                                        <input type='hidden' name='id' value='" . $produto['id_produto'] . "' />
                                        <p> <input  class='inp-qtde' type='number' name='quantidade' min='1' max='100' value='". $itemCarrinho->quantidade ."' /></p>
                                        <p>
                                            <input type='submit' class='btn btn-primary btn-add-carrinho' value='Recalcular' />
                                        </p>
                                    </form>
                                </div>
                                <div class='col-2'>
                                    <p> R$ " . ($produto['valor'] * $itemCarrinho->quantidade) . "</p>
                                </div>                                
                            </div>";
                }
                echo "</div>";

                echo "<div class='col-3 pnl-entrega'>
                    <div class='row'>
                        <div class='col-12'>
                            <div class='form-group'>                        
                                <label for='meio_entrega'>ENTREGA</label>  
                                <select class='form-control' id='meio_entrega' name='meio-entrega'>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                            <div class='form-group'>                        
                                <label for='meio_pagamento'>FORMA DE PAGAMENTO</label>
                                <select class='form-control' id='meio_pagamento' name='meio_pagamento'>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                            <button type='button' class='btn btn-primary btn-block'>Finalizar Pedido</button>
                        </div>
                    </div>
                </div>";
                echo "</div>";


            } else {
                echo "Seu carrinho está vazio :(";
            }
            ?>
        </div>
    </div>    
</body>

</html>