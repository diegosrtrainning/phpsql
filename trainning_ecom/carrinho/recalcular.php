<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $carrinho = [];
    $idProduto = $_POST["id"];
    $quantidade = $_POST["quantidade"];

    if(!empty($_COOKIE["carrinho"]))
    {
        $carrinho = json_decode($_COOKIE["carrinho"], true);
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
        
    $idFind = array_search($idProduto, array_column($carrinho, 'id_produto'));
    
    if($idFind !== false){
        
        unset($carrinho[$idFind]);
        $carrinho = array_values($carrinho);        

        array_push($carrinho, ['id_produto' => $idProduto, 'quantidade' => (int)$quantidade]);
        
        setcookie("carrinho", json_encode($carrinho), time() + (86400), "/"); // 1 dia
    }            
            
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

?>