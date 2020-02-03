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
                <h1>Meu Carrinho</h1>
            </div>            
        </div>                  
        <?php            
            include __DIR__ . "/../libs/db.php";
            include __DIR__ . "/../libs/forms/select.php";
            global $config;
            $carrinho = [];            
            $totalCarrinho = 0;

            if(!empty($_COOKIE["carrinho"]))
            {
                $carrinho = json_decode($_COOKIE["carrinho"], true);
            }             

            $produtosArr = [];

            foreach ($carrinho as $key => $produto) {                
                array_push($produtosArr, $produto['id_produto']);
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
                    $idFind = array_search($produto['id_produto'], array_column($carrinho, 'id_produto'));        
                    $itemCarrinho = $carrinho[$idFind];                    

                    $totalCarrinho += ($produto['valor'] * $itemCarrinho['quantidade']);

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
                                        <p> <input  class='inp-qtde' type='number' name='quantidade' min='1' max='100' value='". $itemCarrinho['quantidade'] ."' /></p>
                                        <p>
                                            <input type='submit' class='btn btn-primary btn-add-carrinho' value='Recalcular' />
                                        </p>
                                    </form>
                                </div>
                                <div class='col-2'>
                                    <p> R$ " . ($produto['valor'] * $itemCarrinho['quantidade']) . "</p>
                                </div>                                
                            </div>";
                }
                echo "</div>";

                $sql = "SELECT
                            p.id_tipo_entrega as id,
                            concat(p.nome, ' (R$ ',  p.preco_frete, ') - ',  p.prazo_entrega, ' dias úteis') AS 'descricao'
                        FROM
                            trainning_ecom_oficial.tipo_entrega p";
        
                $tipos_entrega = read($db, $sql);

                $sql = "SELECT
                            p.ID_FORMA_PAGAMENTO as id,
                            CASE p.PARCELAS 
                                WHEN 1 THEN 
                                    concat(p.nome, ' R$ $totalCarrinho (à vista)')  
                                ELSE concat(p.nome,' ', p.PARCELAS, ' X (R$ ',  ROUND((". $totalCarrinho." / p.PARCELAS), 2), ')') 
                            END AS 'descricao'
                        FROM
                            trainning_ecom_oficial.FORMA_PAGAMENTO P";        

                $formas_pagamento = read($db, $sql);


                echo "<div class='col-3 pnl-entrega'>
                    <div class='row'>
                        <div class='col-12'>
                            ". criarSelect('meio_entrega', 'ENTREGA', $tipos_entrega) ."
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                        ". criarSelect('meio_entrega', 'FORMA DE PAGAMENTO', $formas_pagamento) ."
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                            <hr>
                            <p><span class='sp-total'>TOTAL PEDIDO: R$ </span><span class='sp-total-valor'>$totalCarrinho</span><p>
                        </div>
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