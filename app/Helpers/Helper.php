
<?php

function checkCheckBox($key , $array){
    if ($array != null) {
        if (array_key_exists($key, $array) ) {
           return 'checked';
        }
    }
    return '';
}


function excelCheckBOc($key , $array){

   
        if ($array != null) {
            if (property_exists($key, $array) ) {
               return '1';
            }
        }
        return '';

}
