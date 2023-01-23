<?php

if(isset($_FILES['foto'])){
    $a = rearrange($_FILES['foto']);
    foreach($a as $foto){
        echo $foto['tmp_name'];
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