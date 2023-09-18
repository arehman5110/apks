<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkPackage;
use Illuminate\Support\Facades\DB;

class WPController extends Controller
{
 public  function saveWorkPackage(Request $req){
 
      $zone=$req->zone;
      $ba=$req->ba;
      $name=$req->name;
      $geom=$req->geom;
      
      $sql="INSERT INTO public.tbl_workpackage(
        package_name, geom, zone, ba,wp_status)
        VALUES ('$name', st_geomfromgeojson('$geom'), '$zone', '$ba','pending'); ";
      try {
        $data = DB::insert($sql);
        // DB::disconnect();
    } catch (\Throwable $th ) {
    return $th->getMessage();
    }
    return redirect('map-1');
    
    }


    public function selectWP($id){
      $wp = WorkPackage::find($id);

        return response()->json($wp);    
    }


   public function getRoadInfo(Request $req) {
    $geom = $req->geom;
    $result = DB::select("SELECT id, package_name , ba , zone FROM tbl_workpackage WHERE ST_Intersects(geom, ST_GeomFromGeoJSON('$geom'))");
    return response()->json(['data' => $result, 'status' => "200"],200);
    
   }

}
