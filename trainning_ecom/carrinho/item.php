<?php

function criarItem($produto, $estaNoCarrinho){
   global $config;
   
   $item = '<div class="card col-4" ><div class="card-border">   
        <img src="'. $config["URL_PORTAL"] . "/" . $produto['foto_vitrine']  .'" class="card-img-top" title="'. $produto['descricao'] .'">
        <div class="card-body text-center">
            <h5 class="card-title">'. $produto["nome"] .'</h5>
            <p class="card-text">'.$produto["descricao"] .'</p>';

        if($estaNoCarrinho){
            $item .= '<form method="post" action="carrinho/delete.php" class="form-rmv">
                <input type="hidden" name="id" value="'. $produto["id_produto"] .'" />
                <input type="submit" class="btn btn-danger" value="Remover"/>
            </form>';
        } else{
            $item .= '<form method="post" action="carrinho/create.php" class="form-add">
                <input type="hidden" name="id" value="'. $produto["id_produto"] .'" />
                <input type="submit" class="btn btn-success" value="Adicionar"/>
            </form>';
        }
            
    $item .= '</div>
        </div>
    </div>';

    return $item;
}
?>