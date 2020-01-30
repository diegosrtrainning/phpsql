<?php
    $idEnd = $idCliente = 0;
    $msgSucesso = $msgErro = "";
    
    if(!empty($_GET["idEnd"])){
        $idEnd =  $_GET["idEnd"];
    } else {
        $idCliente = $_GET["idCliente"];
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {         
        // TODO: SALVAR ENDEREÇO
        // TODO: ALTERAR ENDEREÇO
    }
?>

<?php
error_reporting(0);

include __DIR__ . "/../libs/logs.php";

$cep = $logradouro = $bairro = $cidade = $estado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    if(!empty($_POST["cep"])){
        $cep = $_POST["cep"];
        $urlViaCEP = "https://viacep.com.br/ws/$cep/json/";        

        try{
            $context = stream_context_create(array(
                'http' => array('ignore_errors' => true),
            ));

            $response = file_get_contents($urlViaCEP, false, $context);    
            $response = json_decode($response);

            if(empty($response)){
                throw new Exception("CEP $cep não localizado");
            }else {
                $logradouro = $response->logradouro;
                $bairro = $response->bairro;
                $cidade = $response->localidade;
                $estado = $response->uf;        
            }
                                    
        } catch (Exception $e) {
            erro($e);
        }
    }
}
 
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">        
    <title>Bonus 1 - Esqueleto</title>

    <!-- Bootstrap core CSS -->            
    <link href="../css/main.css" rel="stylesheet">    
    <link href="../css/cadastro.css" rel="stylesheet">    
</head>

<body class="">
    <!-- TOPO DA PAGINA -->        
    <?php include __DIR__ . "/../libs/topo.php"; ?>
    
    <div id="container" class="container">                            
        <div class="row">
            <div class="col-12">
                Cadasto 2/3
            </div>
        </div>      
        <div class="row ">
            <div class="col-2 ">
                <form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
                    <div class="form-row align-items-end">                
                        <div class="col-8">
                            <label>CEP</label>
                            <input type="text" name="cep" class="form-control" placeholder="Digite o CEP" value="<?php echo $cep;?>">
                        </div>                
                        <div class="col-4">                    
                            <input type="submit" class="btn btn-primary" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-10">
                <form method="post" action="adicionar-cep.php"  enctype="multipart/form-data">            
                    <input id="idCliente" name="idCliente" value="<?php echo $idCliente; ?>" type="hidden">
                    <input id="idEnd" name="idEnd" value="<?php echo $idEnd; ?>" type="hidden">
                    
                    <input type="hidden" name="cep" value="<?php echo $cep;?>">
                    <!-- Endereço -->
                    <div class="form-row align-items-end">                
                        <div class="col-4">
                            <label>Logradouro</label>
                            <input type="text" name="logradouro" readonly class="form-control" placeholder="Logradouro" value="<?php echo $logradouro;?>">
                        </div>
                        <div class="col-1">
                            <label>Número</label>
                            <input type="text" name="numero" class="form-control" placeholder="Numero">
                        </div>
                        <div class="col-3">
                            <label>Complemento</label>
                            <input type="text" name="complemento" class="form-control" placeholder="Complemento">
                        </div>
                        <div class="col-3">
                            <label>Cidade</label>
                            <input type="text" name="cidade" class="form-control" placeholder="Cidade" value="<?php echo $cidade; ?>" readonly>
                        </div>
                        <div class="col-1">
                            <label>Estado</label>
                            <input type="text" name="estado" class="form-control" placeholder="Estado" value="<?php echo $estado; ?>" readonly>
                        </div>
                    </div>
                    <div class="row justify-content-md-center form-buttons" >            
                        <div class="col-2">
                            <a href="<?php echo ($_SERVER['HTTP_REFERER'] ?? "#"); ?>" class="btn btn-danger" >Voltar</a>
                        </div>
                        <div class="col-2">
                            <input type="submit" class="btn btn-success" value="Salvar" />
                        </div>
                    </div>    
                </form>            
            </div>
        </div>
    </div>    
</body>

</html>