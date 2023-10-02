<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\Road;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoadController extends Controller
{
    public function saveRoad(Request $req)
    {
        // return $req;
        $name = $req->road_name;
        $wp = $req->id_wp;
        $geom = $req->geom;

        $sql = "INSERT INTO public.tbl_roads(
          road_name, geom, id_workpackage , ba , zone)
          VALUES ('$name', st_geomfromgeojson('$geom'), '$wp' , '$req->ba', '$req->zone'); ";
        try {
            $data = DB::insert($sql);
        } catch (\Throwable $th) {
            return redirect('map-1');
            return $th->getMessage();
        }
        return redirect('map-1');
    }

    public function removeRoad($id)
    {
        try {
            $wp = Road::find($id);
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

    public function getRoadName($lat, $lng)
    {
        try {
            $data = DB::select("SELECT road_name
            FROM tbl_roads
            WHERE st_intersects(
                st_buffer(
                    st_transform(st_geomfromtext('POINT($lng $lat)', 4326), 32647),
                    100, 2
                ),
                    st_transform(geom, 32647)
                )
            ");
            return $data;
        } catch (\Throwable $th) {
            return response()->json(['Success' => false, 'error' => $th->getMessage()], 500);
        }
    }
}
