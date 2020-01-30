<?php

function criarItem($produto){
   $item = '<div class="card col-4" ><div class="card-border">
        <img src="'. $produto->imagem .'" class="card-img-top" alt="notebook">
        <div class="card-body text-center">
            <h5 class="card-title">'. $produto->nome .'</h5>
            <p class="card-text">'.$produto->descricao.'</p>
            
                <form method="post" action="includes/vitrine/rmv-item.php" class="form-rmv">
                    <input type="hidden" name="id" value="'. $produto->id .'" />
                    <input type="submit" class="btn btn-danger" value="Remover"/>
                </form>
                <form method="post" action="includes/vitrine/add-item.php" class="form-add">
                    <input type="hidden" name="id" value="'. $produto->id .'" />
                    <input type="submit" class="btn btn-success" value="Adicionar"/>
                </form>            
        </div>
        </div>
    </div>';

    return $item;
}
?>