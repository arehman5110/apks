<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\Road;
use Illuminate\Http\Request;
use App\Models\WorkPackage;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class WPController extends Controller
{
    public function saveWorkPackage(Request $req)
    {
        $zone = $req->zone;
        $ba = $req->ba;
        $name = $req->name;
        $geom = $req->geom;

        $sql = "INSERT INTO public.tbl_workpackage(
        package_name, geom, zone, ba,wp_status)
        VALUES ('$name', st_geomfromgeojson('$geom'), '$zone', '$ba',''); ";
        try {
            $data = DB::insert($sql);
            // DB::disconnect();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        return redirect('map-1');
    }

    public function selectWP($ba, $zone)
    {
        // return  "select id, package_name ,st_x(st_centroid(geom)) as x  ,st_y(st_centroid(geom)) as y from tbl_workpackage  where ba= '$ba' and zone = '$zone'";
        $wp = DB::select("select id, package_name ,st_x(st_centroid(geom)) as x  ,st_y(st_centroid(geom)) as y from tbl_workpackage  where ba= '$ba' and zone = '$zone'");

        return response()->json($wp);
    }

    public function getRoadInfo(Request $req)
    {
        $geom = $req->geom;
        $result = DB::select("SELECT id, package_name , ba , zone FROM tbl_workpackage WHERE ST_Intersects(geom, ST_GeomFromGeoJSON('$geom'))");
        return response()->json(['data' => $result, 'status' => '200'], 200);
    }

    public function getBaInfo(Request $req)
    {
        $geom = $req->geom;
        $result = DB::select("SELECT ppb_zone, station  FROM ba WHERE ST_Intersects(geom, ST_GeomFromGeoJSON('$geom'))");
        return response()->json([$result[0]], 200);
    }

    public function detail($id)
    {
        $rec = WorkPackage::withCount('diging')->find($id);

        $wp = WorkPackage::selectRaw('ST_X(ST_Centroid(geom)) as x')
            ->selectRaw('ST_Y(ST_Centroid(geom)) as y')
            ->where('ba', $rec->ba)
            ->where('zone', $rec->zone)
            ->first();

        $road = Road::selectRaw('(ST_Length(geom::geography))/1000 as distance')
            ->where('id_workpackage', $id)
            ->get();

        return $rec != '' ? view('map.show', ['rec' => $rec, 'wp' => $wp, 'distance' => $road->sum('distance')]) : abort(404);
    }
    public function getStats($wp)
    {
        $wp_id = $wp;
        $result = DB::select("SELECT (sum(st_length(geom::geography)))/1000 as distance FROM tbl_roads where id_workpackage='$wp_id'");
        $result1 = DB::select("SELECT count(*)  FROM tbl_third_party_diging_patroling where workpackage_id='$wp_id' and service_status='notice'");
        $result2 = DB::select("SELECT count(*)  FROM tbl_third_party_diging_patroling where workpackage_id='$wp_id' and service_status='supervise'");
    

        return response()->json([$result[0], $result1[0], $result2[0]], 200);
    }

    public function removeWP($id)
    {
        try {
            $wp = WorkPackage::find($id);
            if ($wp) {
                $wp->delete();
            }
            return redirect()
                ->back()
                ->with('success', 'Remove records successfully');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('failed', 'try again later');
        }
    }
}
