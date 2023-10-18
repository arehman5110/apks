<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

function checkCheckBox($key, $array)
{
    try {
        //code...

        if ($array != null) {
            if (array_key_exists($key, $array)) {
                return 'checked';
            }
        }
        return '';
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function substaionCheckBox($key, $array)
{
    try {
        if ($array != null) {
            if ($array->$key == 'true') {
                return 'checked';
            }
        }
        return '';
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function excelCheckBOc($key, $array)
{
    if ($array != null) {
        if (property_exists($key, $array)) {
            return '1';
        }
    }
    return '';
}

function getZone()
{
    $zone = '';
    $ba = Auth::user()->ba;

    if (empty($ba)) {
        $zone = '<option value="" hidden>select zone</option>
        <option value="W1">W1</option>
        <option value="B1">B1</option>
        <option value="B2">B2</option>
        <option value="B4">B4</option>';
    } else {
        $sql = DB::select('SELECT ppb_zone FROM ba WHERE station = ?', [$ba]);

        if (count($sql) > 0) {
            $zone = '<option value="' . $sql[0]->ppb_zone . '">' . $sql[0]->ppb_zone . '</option>';
        }
    }

    return $zone;
}

function getImage($checkBox, $arr, $key)
{
    try {
        if ($checkBox == 'checked') {
            if ($arr != null) {
                if (array_key_exists($key, $arr) && file_exists(public_path($arr[$key])) && $arr[$key] != '') {
                    return '<a href="' .
                        URL::asset($arr[$key]) .
                        '" data-lightbox="roadtrip">
                            <img src="' .
                        URL::asset($arr[$key]) .
                        '" alt="" class="adjust-height mb-1" style="height:30px; width:30px !important">
                        </a>';
                }
            }
        } else {
            return '';
        }
        return "<span style='font-size:11px'>no image found</span>";
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function getImage2($key, $arr, $arr_name, $img_arr, $lab_name)
{
    $html = '';

    // Check for checked checkbox
    $key_exist = !empty($arr) && array_key_exists($key, $arr);

    $id = $arr_name . '_' . $key;
    $name = $arr_name . '[' . $key . ']';
    $image_name = $arr_name . '_image[' . $key . ']';
    $image_name_2 = "{$arr_name}_image[{$key}_2]";

    // Check if $key is "other" to decide the CSS classes
    $class = $key != 'other' ? 'd-flex' : '';

    $html .=
        "<td class='$class'>
                <input type='checkbox' name='$name' id='$id' " .
        ($key_exist ? 'checked' : '') .
        " class='form-check'>
                <label class='text-capitalize' for='$id'> $lab_name</label>";

    if ($key == 'other') {
        $key2 = $key . '_input';
        $otherValue = isset($arr[$key2]) ? $arr[$key2] : '';
        $html .= "<input type='text' name='{$arr_name}[{$key2}]' id='{$id}-input'  value='$otherValue' class='form-control " . ($key_exist ? '' : 'd-none') . "' placeholder='mention other defect'>";
    }

    $html .=
        "</td>
              <td>
                <input type='file' name='$image_name' id='{$id}-image' class='" .
        ($key_exist ? '' : 'd-none') .
        " form-control'>
                <input type='file' name='$image_name_2' id='{$id}-image-2' class='" .
        ($key_exist ? '' : 'd-none') .
        " form-control'>
              </td>
              <td>";

    if ($img_arr != '') {
        if (array_key_exists($key, $img_arr) && file_exists(public_path($img_arr[$key])) && $img_arr[$key] != '') {
            $html .=
                "<a href='" .
                URL::asset($img_arr[$key]) .
                "' data-lightbox='roadtrip'>
                <img src='" .
                URL::asset($img_arr[$key]) .
                "' class='adjust-height mb-1' style='height:30px; width:30px !important'>
            </a>";
        }

        if (array_key_exists($key . '_2', $img_arr) && file_exists(public_path($img_arr[$key . '_2'])) && $img_arr[$key . '_2'] != '') {
            $html .=
                "<a href='" .
                URL::asset($img_arr[$key . '_2']) .
                "' data-lightbox='roadtrip'>
                <img src='" .
                URL::asset($img_arr[$key . '_2']) .
                "' class='adjust-height mb-1' style='height:30px; width:30px !important'>
            </a>";
        }
        # code...
    }
    $html .= '</td>';

    return $html;
}

function getImageShow($key, $arr, $arr_name, $img_arr, $lab_name)
{
    $html = '';

    // Check for checked checkbox
    $key_exist = !empty($arr) && array_key_exists($key, $arr);

    $id = $arr_name . '_' . $key;
    $name = $arr_name . '[' . $key . ']';
 

    // Check if $key is "other" to decide the CSS classes
    $class = $key != 'other' ? 'd-flex' : '';

    $html .=
        "<td class='$class'>
                <input type='checkbox' name='$name' id='$id' " . ($key_exist ? 'checked' : '') ." class='form-check' disabled>
                <label class='text-capitalize' for='$id'> $lab_name</label>";

    if ($key == 'other') {
        $key2 = $key . '_input';
        $otherValue = isset($arr[$key2]) ? $arr[$key2] : '';
        $html .= "<input type='text'  id='{$id}-input'  value='$otherValue' class='form-control " . ($key_exist ? '' : 'd-none') . "' placeholder='mention other defect' disabled>";
    }

    $html .= "</td>
    <td class=''>";

    if ($img_arr != '') {
        if (array_key_exists($key, $img_arr) && file_exists(public_path($img_arr[$key])) && $img_arr[$key] != '') {
            $html .=
                "<a href='" .URL::asset($img_arr[$key]) . "' data-lightbox='roadtrip'>
                    <img src='" . URL::asset($img_arr[$key]) . "' class='adjust-height mb-1' style='height:30px; width:30px !important'>
                </a>";
        }

        if (array_key_exists($key . '_2', $img_arr) && file_exists(public_path($img_arr[$key . '_2'])) && $img_arr[$key . '_2'] != '') {
            $html .=
                "<a href='" .  URL::asset($img_arr[$key . '_2']) . "' data-lightbox='roadtrip'>
                    <img src='" .  URL::asset($img_arr[$key . '_2']) . "' class='adjust-height mb-1' style='height:30px; width:30px !important'>
                </a>";
        }
    }
    $html .= '</td>';

    return $html;
}
