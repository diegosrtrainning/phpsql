<?php
function erro(Exception $e) {
    
    session_start();
            
    $arquivo = "erro_" .date("Y-m-d") . ".txt";
    $myfile = __DIR__."/logs/". $arquivo;
    date_default_timezone_set("America/Recife");        
    $data = date("d/m/Y H:i:s");

    $templateLog = "[%1\$s] => %2\$s\nArquivo: %3\$s\nLinha: %4\$d\nErro: %5\$s\n";
    $erro = sprintf($templateLog, 
                    $data, 
                    $_SESSION["nommeUsuario"] ?? "", 
                    $e->getFile(), 
                    $e->getLine(), 
                    $e->getMessage());

    $current = file_get_contents($myfile);
    $current .= $erro."\n";
    file_put_contents($myfile, $current);    
}
?>