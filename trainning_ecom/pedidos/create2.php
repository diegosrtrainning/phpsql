<?php
    include __DIR__ . "/../libs/db2.php";
    include __DIR__ . "/../libs/logs.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {               
        $db = null;
        try {                        
            if(!isset($_SESSION)){session_start();}
            $endereco = $_POST["endereco"];
            $meio_entrega = $_POST["meio_entrega"];
            $forma_pagamento = $_POST["forma_pagamento"];
            $total_carrinho = $_POST["total_carrinho"];        
            
            $params = [
                        "id_endereco_entrega" => $endereco, 
                        "valor_total" => $total_carrinho, 
                        "id_cliente" => $_SESSION["idCliente"] , 
                        "id_tipo_entrega" => $meio_entrega
            ];

            $sqlPedido = "INSERT INTO trainning_ecom_oficial.pedido
                (data, id_endereco_entrega, valor_total, id_cliente, id_tipo_entrega)
                VALUES(now(), :id_endereco_entrega, :valor_total, :id_cliente, :id_tipo_entrega)";

            $db = conectar();    
            $db->beginTransaction();
            $idPedido = create($db, $sqlPedido, $params);            
                    
            $carrinho = [];            
            
            if(!empty($_COOKIE["carrinho"]))
            {
                $carrinho = json_decode($_COOKIE["carrinho"], true);
            }

            $produtosArr = [];

            foreach ($carrinho as $key => $produto) {                            
                array_push($produtosArr, $produto['id_produto']);
            }

            $produtos = implode(',', $produtosArr);

            $sqlProduto = "SELECT
                        p.id_produto,                            
                        p.valor
                    FROM
                        trainning_ecom_oficial.produto p
                        INNER JOIN trainning_ecom_oficial.CATEGORIA c ON p.ID_CATEGORIA = c.ID_CATEGORIA                        
                    WHERE 
                        p.ID_PRODUTO IN ($produtos);";
            
            $produtos_carrinho = read($db, $sqlProduto);

            $sqlItensPedido = "INSERT INTO trainning_ecom_oficial.pedido_item
            (id_pedido, id_produto, valor_unitario, quantidade, valor_total, id_pedido_item_status)
            VALUES(:id_pedido, :id_produto, :valor_unitario, :quantidade, :valor_total, :id_pedido_item_status)";

            foreach ($produtos_carrinho as $key => $produto) {
                $idFind = array_search($produto['id_produto'], array_column($carrinho, 'id_produto'));        
                $itemCarrinho = $carrinho[$idFind];                    

                $params = [
                    "id_pedido" => $idPedido,
                    "id_produto" => $produto["id_produto"], 
                    "valor_unitario" => $produto["id_produto"], 
                    "quantidade" => $itemCarrinho['quantidade'],
                    "valor_total" => ($produto['valor'] * $itemCarrinho['quantidade']),
                    "id_pedido_item_status" => 1
                ];                
                
                $idItem = create($db, $sqlItensPedido, $params);
            }
            
            $params = [
                    "id_pedido" => $idPedido,
                    "id_forma_pagamento" => $forma_pagamento
            ];

            $sqlFormaPagamento = "INSERT INTO trainning_ecom_oficial.pedido_forma_pagamento
                (id_pedido, id_forma_pagamento)
            VALUES(:id_pedido, :id_forma_pagamento)";

            $idFormaPagamento = create($db, $sqlFormaPagamento, $params);
            $db->commit();
            setcookie("carrinho", json_encode([]), time() + 86400, "/"); // 1 dia

            header('Location: ' . $config["URL_PORTAL"] . "/pedidos");
            exit;

        } catch (Exception $e) {            
            if($db != null){
                $db->rollback();
            }

            erro($e);
        }                                                
    }
?>