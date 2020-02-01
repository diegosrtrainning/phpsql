<?php

function dateParse($data){    
    $dataArr = explode('/', $data);
    return $dataArr[2] . '-' . $dataArr[1] . '-' . $dataArr[0]; 
}

?>