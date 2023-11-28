<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Substation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubstationMapController extends Controller
{
    //

    public function editMap($lang, $id)
    {
        $data = Substation::find($id);
        return $data ? view('substation.edit-form', ['data' => $data]) : abort(404);
    }
    public function update(Request $request, $language, $id)
    {
        try {
            $currentDate = Carbon::now()->toDateString();
            $combinedDateTime = $currentDate . ' ' . $request->patrol_time;

            $data = Substation::find($id);
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            // $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $combinedDateTime;

            $data->voltage = $request->voltage;
            $data->name = $request->name;
            $data->type = $request->type;
            // $data->coordinate = $request->coordinate;
            $data->grass_status = $request->grass_status;
            $data->tree_branches_status = $request->tree_branches_status;

            $data->advertise_poster_status = $request->advertise_poster_status;
            $gate = ['locked' => 'false', 'unlocked' => 'false', 'demaged' => 'false', 'other' => 'false', 'other_value' => ''];

            if ($request->has('gate_status')) {
                $gateStatus = $request->gate_status;

                foreach ($gate as $key => $value) {
                    if (array_key_exists($key, $gateStatus)) {
                        if ($key == 'other_value') {
                            $gate['other_value'] = $request->gate_status['other_value'];
                        } else {
                            $gate[$key] = 'true';
                        }
                    }
                }
            }

            $data->gate_status = json_encode($gate);

            $building = ['broken_roof' => 'false', 'broken_gutter' => 'false', 'broken_base' => 'false', 'other' => 'false', 'other_value' => ''];

            if ($request->has('building_status')) {
                $buildingStatus = $request->building_status;

                foreach ($building as $key => $value) {
                    if (array_key_exists($key, $buildingStatus)) {
                        if ($key == 'other_value') {
                            $building['other_value'] = $request->building_status['other_value'];
                        } else {
                            $building[$key] = 'true';
                        }
                    }
                }
            }
            $data->building_status = json_encode($building);
            // return $data;

            $destinationPath = 'assets/images/link-box/';

            foreach ($request->all() as $key => $file) {
                // Check if the input is a file and it is valid
                if ($request->hasFile($key) && $request->file($key)->isValid()) {
                    $uploadedFile = $request->file($key);
                    $img_ext = $uploadedFile->getClientOriginalExtension();
                    $filename = $key . '-' . strtotime(now()) . '.' . $img_ext;
                    $uploadedFile->move($destinationPath, $filename);
                    $data->{$key} = $destinationPath . $filename;
                }
            }

            //  $data->geom = DB::raw("ST_GeomFromText('POINT(".$request->log." ".$request->lat.")',4326)");

            $data->update();

            return view('components.map-messages', ['id' => $id, 'success' => true, 'url' => 'substation'])->with('success', 'Form Update');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return view('components.map-messages', ['id' => $id, 'success' => false, 'url' => 'substation'])->with('failed', 'Form Update Failed');
        }
    }

    public function seacrh($lang ,  $q)
    {

        $ba = \Illuminate\Support\Facades\Auth::user()->ba;

        $data = Substation::where('ba', 'LIKE', '%' . $ba . '%')->where('name' , 'LIKE' , '%' . $q . '%')->select('name')->limit(10)->get();

        return response()->json($data, 200);
    }

    public function seacrhCoordinated($lang , $name)
    {
        $name = urldecode($name);
        $data = Substation::where('name' , 'LIKE' , '%' . $name . '%')->select('name', \DB::raw('ST_X(geom) as x'),\DB::raw('ST_Y(geom) as y'),)->first();

        return response()->json($data, 200);
    }
}
