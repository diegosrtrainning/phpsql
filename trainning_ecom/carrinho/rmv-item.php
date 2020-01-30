<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {       
    $id = $_POST["id"];

    $carrinho = [];
    if(!empty($_COOKIE["carrinho"]))
    {
        $carrinho = json_decode($_COOKIE["carrinho"]);
    } 
        
    $idFind = array_search($id,$carrinho);
    
    if($idFind !== false){
        unset($carrinho[$idFind]);
        $carrinho = array_values($carrinho);        

        setcookie("carrinho", json_encode($carrinho), time() + (86400 * 30), "/"); // 1 dia
    }            
    
    header("Location: /phpfoundation/bonus/bonus1/vitrine.php");
    exit;
}

?>