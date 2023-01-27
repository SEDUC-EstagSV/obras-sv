<?php

function validateInput($value) {
    if(is_numeric($value)){
        return $value;
    } else {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }
}

function validateArray($array){
	$i = 0;
    foreach($array as $value){
        if(!is_numeric($value)){
        	$array[$i] = -1;
        }  
        $i++;
    }
    return $array;
}

?>