
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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


function getZone(){
    $zone = '';
    $ba = Auth::user()->ba;

    if (empty($ba)) {
        $zone = '<option value="" hidden>select zone</option>
        <option value="W1">W1</option>
        <option value="B1">B1</option>
        <option value="B2">B2</option>
        <option value="B4">B4</option>';
    } else {
       
        $sql = DB::select("SELECT ppb_zone FROM ba WHERE station = ?", [$ba]);

        if (count($sql) > 0) {
            $zone = '<option value="'.$sql[0]->ppb_zone.'">'.$sql[0]->ppb_zone.'</option>';
        }
    }
    
    return $zone;
}

function getImage($checkBox, $arr, $key) {
 
    if ($checkBox == 'checked') {
        if ($arr != null) {
            if (array_key_exists($key, $arr) && file_exists(public_path($arr[$key])) && $arr[$key] != '') {
                return '<a href="' . URL::asset($arr[$key]) . '" data-lightbox="roadtrip">
                            <img src="' . URL::asset($arr[$key]) . '" alt="" class="adjust-height " style="height:30px; width:30px !important">
                        </a>';
            }
        }
    }else{
        return '';
    }
    return "<span style='font-size:11px'>no image found</span>";
}
