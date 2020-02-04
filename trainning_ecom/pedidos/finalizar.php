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
                <h1>Finalizar Pedido</h1>
            </div>            
        </div>                  
        <?php            
            include __DIR__ . "/../libs/validarsessao-cliente.php";
            include __DIR__ . "/../libs/db2.php";
            include __DIR__ . "/../libs/forms/select.php";

            global $config;
            $carrinho = [];            
            $totalCarrinho = 0;
            $meio_entrega = $_GET["meio_entrega"];
            $forma_pagamento = $_GET["forma_pagamento"];

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
                                                                                
                echo  "<div class='row'>
                <div class='col-3 pnl-endereco'>";                
                ?>
                    <form action="create2.php" method="post">
                        <input id="meio_entrega" name="meio_entrega" value="<?php echo $meio_entrega; ?>" type="hidden"> 
                        <input id="forma_pagamento" name="forma_pagamento" value="<?php echo $forma_pagamento; ?>" type="hidden">                         
                        
                        <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Endereço</th>                                                            
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
                                                "<td><input type='radio' name='endereco' value='" . $endereco['id'] ."' />".                                            
                                                "<td>" . $endereco['endereco'] ."</td>".                                                                                                    
                                            "</tr>";
                                    }
                                ?>
                        </tbody>
                    </table>
                    <div class='col-12'>                            
                        <a href="<?php global $config; echo $config["URL_PORTAL"] ."/carrinho"; ?>" class='btn btn-danger'>Voltar</a> 
                        <input type='submit' class='btn btn-success' value='Concluir Pedido' />
                    </div>                
            <?php
                echo "</div>
                <div class='col-6'>
                    <div class='row itens-titulo'>
                        <div class='col-3'>Foto</div>
                        <div class='col-3'>Item</div>                        
                        <div class='col-2'>Preço</div>
                        <div class='col-1'>Qtde</div>
                        <div class='col-2'>Subtotal</div>
                    </div>";
                foreach ($produtos_carrinho as $key => $produto) {
                    $idFind = array_search($produto['id_produto'], array_column($carrinho, 'id_produto'));        
                    $itemCarrinho = $carrinho[$idFind];                    

                    $totalCarrinho += ($produto['valor'] * $itemCarrinho['quantidade']);

                    echo  "<div class='row item-container'>
                                <div class='col-3'>
                                    <img class='img-carrinho' src='" . $config["URL_PORTAL"] . "/" . $produto['foto_vitrine'] ."'/>                                    
                                </div>
                                <div class='col-3'>
                                    <p class='p-desc-item'>" . $produto['nome'] . "<br>" .
                                    $produto['descricao'] . "</p>
                                </div>
                                <div class='col-2'>
                                    <p> R$ " . $produto['valor'] . "</p>
                                </div>
                                <div class='col-1'>                                    
                                        <p>". $itemCarrinho['quantidade'] ."</p>                                        
                                </div>
                                <div class='col-2'>
                                    <p> R$ " . ($produto['valor'] * $itemCarrinho['quantidade']) . "</p>
                                </div>                                
                            </div>";
                }
                echo "</div>
                <input id='total_carrinho' name='total_carrinho' value='". $totalCarrinho ."' type='hidden' />  
                </form>";

                $sql = "SELECT
                            p.id_tipo_entrega as id,
                            concat(p.nome, ' (R$ ',  p.preco_frete, ') - ',  p.prazo_entrega, ' dias úteis') AS 'descricao'
                        FROM
                            trainning_ecom_oficial.tipo_entrega p
                        WHERE id_tipo_entrega = " . $meio_entrega;
        
                $tipos_entrega = read($db, $sql);

                $sql = "SELECT
                            p.ID_FORMA_PAGAMENTO as id,
                            CASE p.PARCELAS 
                                WHEN 1 THEN 
                                    concat(p.nome, ' R$ $totalCarrinho (à vista)')  
                                ELSE concat(p.nome,' ', p.PARCELAS, ' X (R$ ',  ROUND((". $totalCarrinho." / p.PARCELAS), 2), ')') 
                            END AS 'descricao'
                        FROM
                            trainning_ecom_oficial.FORMA_PAGAMENTO P
                        WHERE ID_FORMA_PAGAMENTO = " . $forma_pagamento; 

                $formas_pagamento = read($db, $sql);                                

                echo "<div class='col-3 pnl-entrega'>
                    <div class='row'>
                        <div class='col-12'>
                            <h4>ENTREGA</h4>
                            ". $tipos_entrega[0]["descricao"] ."
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                        <h4>FORMA PAGAMENTOS</h4>
                        ". $formas_pagamento[0]["descricao"] ."
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                            <hr>
                            <p><span class='sp-total'>TOTAL PEDIDO: R$ </span><span class='sp-total-valor'>$totalCarrinho</span><p>
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