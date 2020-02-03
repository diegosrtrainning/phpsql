<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {    
    $carrinho = [];
    $idProduto = $_POST["id"];

    if(!empty($_COOKIE["carrinho"]))
    {
        $carrinho = json_decode($_COOKIE["carrinho"]);
    } 
    
    array_push($carrinho, ['id_produto' => $idProduto, 'quantidade' => 1]);
    setcookie("carrinho", json_encode($carrinho), time() + 86400, "/"); // 1 dia
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

?>