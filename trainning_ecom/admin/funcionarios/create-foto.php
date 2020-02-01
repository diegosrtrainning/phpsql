<?php
    $id = $_POST["id"];
    include __DIR__ . "/../../libs/db.php";

    $target_dir = "media/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        basename( $_FILES["foto"]["name"]);

        $db = conectar();
        global $config; 
        session_start();
        $params = [
            "foto" => "admin/funcionarios/" . $target_file,
            "id_usuario" => $id
        ];

        $sql = "UPDATE " . $config["DB_DATABASE"] . ".funcionario" .
        " SET foto = :foto WHERE id_usuario = :id_usuario";

        update($db, $sql, $params);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } 

?>