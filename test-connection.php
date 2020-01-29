<?php
$conexao = mysqli_connect("127.0.0.1", "root", "", "trainning_ecom");

if (!$conexao) {
    echo "Falha";    
    exit;
}

echo "Successo";

mysqli_close($conexao);
?>