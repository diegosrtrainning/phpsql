<?php
    $id = 0;
    if(!empty($_GET["id"])){
        $id =  $_GET["id"];
    }
?>

<?php
error_reporting(0);

include __DIR__ . "/libs/logs.php";

// Simple Object Access Protocol (SOAP)
$urlWsdl1 = "http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL";

$urlWsdl2 = "https://footballpool.dataaccess.eu/info.wso?WSDL";
// Métodos: https://footballpool.dataaccess.eu/info.wso

try{
    $client = new SoapClient($urlWsdl2);
    $result = $client->GroupInfo();
    //var_dump($result);    
    $Grupos = $result->GroupInfoResult->tGroupInfo;        
}catch(SoapFault $e){
    erro($e);
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
    <link href="css/main.css" rel="stylesheet">    
    <link href="css/cadastro.css" rel="stylesheet">    
</head>

<body class="">
    <!-- TOPO DA PAGINA -->        
    <?php include __DIR__ . "/includes/topo.php"; ?>
    <div id="container" class="container">                      
        <div class="row">
            <div class="col-12">
                Cadasto 3/3
            </div>
        </div>      
        <form method="post" action="<?php $_SERVER["PHP_SELF"]?>"  enctype="multipart/form-data">            
            <div class="form-row form-endereco align-items-end">                
                    <div class="col-12">
                        <div class="form-group">                        
                            <label for="exampleFormControlSelect1">Grupo</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                            <?php
                                foreach ($Grupos as $grupo) {                                
                                    echo "<option value='" . $grupo->iId . "'>". $grupo->sDescription . "</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>                                    
                
            </div>
            <div class="row justify-content-md-center form-buttons" >            
                <div class="col-2">
                    <a href="cadastro-endereco.php" class="btn btn-danger" >Voltar</a>
                </div>
                <div class="col-1">
                    <input type="submit" class="btn btn-success" value="Avançar" />
                </div>
            </div>    
        </form>            
    </div>    
</body>

</html>