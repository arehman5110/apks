<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkPackage;
use Illuminate\Support\Facades\DB;

class WPController extends Controller
{
    public function saveWorkPackage(Request $req)
    {
        $zone = $req->zone;
        $ba = $req->ba;
        $name = $req->name;
        $geom = $req->geom;

        $sql = "INSERT INTO public.tbl_workpackage(
        package_name, geom, zone, ba)
        VALUES ('$name', st_geomfromgeojson('$geom'), '$zone', '$ba'); ";
        try {
            $data = DB::insert($sql);
            // DB::disconnect();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return redirect()->back();
    }


    public function selectWP(){
      $wp = DB::table('tbl_workpackage')
            ->select('id','package_name')
            ->get();

        return response()->json($wp);    
    }

}
