<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {       
    $id = $_POST["id"];

    $carrinho = [];
    if(!empty($_COOKIE["carrinho"]))
    {
        $carrinho = json_decode($_COOKIE["carrinho"]);
    } 
        
    array_push($carrinho, $id);            
    setcookie("carrinho", json_encode($carrinho), time() + (86400 * 30), "/"); // 1 dia
    
    header("Location: /phpfoundation/bonus/bonus1/vitrine.php");
    exit;
}

?>