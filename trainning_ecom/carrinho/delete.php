<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {       
    $idProduto = $_POST["id"];
    $carrinho = [];
    if(!empty($_COOKIE["carrinho"]))
    {
        $carrinho = json_decode($_COOKIE["carrinho"]);
    } 
        
    $idFind = array_search($idProduto,$carrinho);
    
    if($idFind !== false){
        unset($carrinho[$idFind]);
        $carrinho = array_values($carrinho);        

        setcookie("carrinho", json_encode($carrinho), time() + (86400), "/"); // 1 dia
    }            
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

?>