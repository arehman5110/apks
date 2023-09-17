<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoadController extends Controller
{
    public  function saveRoad(Request $req){
 
        $name=$req->road_name;
        $wp=$req->id_wp;
        $geom=$req->geom;
        
        $sql="INSERT INTO public.tbl_road(
          road_name, geom, id_workpackage)
          VALUES ('$name', st_geomfromgeojson('$geom'), '$wp'); ";
        try {
          $data = DB::insert($sql);
          // DB::disconnect();
      } catch (\Throwable $th ) {
      return $th->getMessage();
      }
      return redirect()->back();
      
      }
}
