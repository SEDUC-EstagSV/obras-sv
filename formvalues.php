<?php

if(isset($_FILES['foto'])){
    $allowTypes = array('jpg','png','jpeg','gif'); 

    $a = rearrange($_FILES['foto']);
    foreach($a as $foto){
        if(in_array($foto['type'], $foto)){
            $novaFoto = addslashes (file_get_contents($foto['tmp_name']));

        } else {
            echo "nao";
        }
    } 
} else {
    echo 'teste2';
}

function rearrange( $arr ){
    foreach( $arr as $key => $all ){
        foreach( $all as $i => $val ){
            $new[$i][$key] = $val;    
        }    
    }
    return $new;
}


?>