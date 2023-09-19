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
        VALUES ('$name', st_geomfromgeojson('$geom'), '$zone', '$ba',''); ";
      try {
        $data = DB::insert($sql);
        // DB::disconnect();
    } catch (\Throwable $th ) {
    return $th->getMessage();
    }
    return redirect('map-1');
    
    }


    public function selectWP($ba , $zone){
     // return  "select id, package_name ,st_x(st_centroid(geom)) as x  ,st_y(st_centroid(geom)) as y from tbl_workpackage  where ba= '$ba' and zone = '$zone'";
      $wp = DB::select("select id, package_name ,st_x(st_centroid(geom)) as x  ,st_y(st_centroid(geom)) as y from tbl_workpackage  where ba= '$ba' and zone = '$zone'");

        return response()->json($wp);    
    }


   public function getRoadInfo(Request $req) {
    $geom = $req->geom;
    $result = DB::select("SELECT id, package_name , ba , zone FROM tbl_workpackage WHERE ST_Intersects(geom, ST_GeomFromGeoJSON('$geom'))");
    return response()->json(['data' => $result, 'status' => "200"],200);
    
   }


   public function getBaInfo(Request $req) {
    $geom = $req->geom;
    $result = DB::select("SELECT ppb_zone, station  FROM ba WHERE ST_Intersects(geom, ST_GeomFromGeoJSON('$geom'))");
    return response()->json([ $result[0]],200);
    
   }

}
