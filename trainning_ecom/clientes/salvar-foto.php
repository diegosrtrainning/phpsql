<?php
$target_dir = "media/clientes/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//Verifica se é uma imagem
if(isset($_POST["Enviar"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
    if($check !== false) {
        echo "Arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Arquivo não é uma imagem.";
        $uploadOk = 0;
    }
}
// Verifica se imagem existe
if (file_exists($target_file)) {
    echo "Desculpe, imagem já exise.";
    $uploadOk = 0;
}
// Validando tamanho máximo permitido
if ($_FILES["fileToUpload"]["size"] > 500000) { // 1MB
    echo "Tamanho máximo permitido é de 1 MB";
    $uploadOk = 0;
}

// Validando o formato
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Ocorreu uma falha.";

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "A imagem ". basename( $_FILES["fileToUpload"]["name"]). " foi salva com sucesso.";
    } else {
        echo "Falha ao salvar imagem.";
    }
}
?>