<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkPackage;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
 public  function saveWorkPackage(Request $req){
 
      $zone=$req->zone;
      $ba=$req->ba;
      $name=$req->name;
      $geom=$req->geom;
      
      $sql="INSERT INTO public.tbl_workpackage(
        package_name, geom, zone, ba)
        VALUES ('$name', st_geomfromgeojson('$geom'), '$zone', '$ba'); ";
      try {
        $data = DB::insert($sql);
        // DB::disconnect();
    } catch (Exception $e) {
        return response()->json(
            [
                'success' => false,
                'message' => 'failed',
                'error' => $e->getMessage(),
            ],
            500,
        );
    }
    
    }
}
