<?php

function criarListBox($pLegend, $pName, $pLista){
    $labelTemplate = "<legend>$pLegend</legend>";    
    $labelTemplate .= "<labelTemplate class=\"rb-container\">{1}";
    $labelTemplate .= "    <input type=\"checkbox\" name='" . $pName ."[]' value=\"{0}\">";
    $labelTemplate .= "    <span class=\"checkmark\"></span>";
    $labelTemplate .= "</labelTemplate>";
    
    $label = $labels = "";

    foreach ($pLista as $value => $description) {        
        $label = str_replace("{0}", $value, $labelTemplate);  
        $label = str_replace("{1}", $description, $label);  

        $labels .= $label;
    }
        
    return $labels;
}
?>