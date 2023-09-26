
<?php

function checkCheckBox($key , $array){
    if (($array != null)) {
        if (array_key_exists($key, $array) ) {
           return 'checked';
        }
    }
    return '';
}
