<?php

function criarSelect($name, $label, $array){

    $optionTemplate = '<option value="%1$s">%2$s</option>';
    $options = $option = "";

    foreach ($array as $key => $lista) {        
        $option = sprintf($optionTemplate, $lista['id'], $lista['descricao']);  
        $options .= $option;    
    }            
    
    $select = "<div class='form-group'><label for='$name'>$label</label>  <select class='form-control' name='$name'>$options</select></div>";   
    return $select;
}
?>