function validateTextInput($inputValue){
    if(!$inputValue || isNumeric($inputValue)){
        return false;
    } else {
        return true;
    }
}

function validateNumberInput($inputValue){
    if(!$inputValue || !isNumeric($inputValue)){
        return false;
    } else {
        return true;
    }
}

function isNumeric($value){
    return !isNaN($value);
}

export {validateTextInput, validateNumberInput};