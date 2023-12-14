<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\FeederPillar;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
class FeederPillarMapController extends Controller
{
    //
    public function editMap($lang, $id)
    {

    $data = FeederPillar::find($id);
    return $data ?  view('feeder-pillar.edit-form', ['data' => $data]) : abort(404);

}

public function update(Request $request, $language, $id)
{
    //


    try {
        $currentDate = Carbon::now()->toDateString();
        $combinedDateTime = $currentDate . ' ' . $request->patrol_time;

        $data = FeederPillar::find($id);
        $data->zone = $request->zone;
        $data->ba = $request->ba;
        // $data->team = $request->team;
        $data->visit_date = $request->visit_date;
        $data->patrol_time = $combinedDateTime;

        $data->size = $request->size;
        $data->coordinate = $request->coordinate;
        $data->leaning_angle = $request->leaning_angle;
        $data->vandalism_status = $request->vandalism_status;
        $data->leaning_staus = $request->leaning_staus;
        $data->rust_status = $request->rust_status;
        $data->advertise_poster_status = $request->advertise_poster_status;
        $gate = ['locked' => 'false', 'unlocked' => 'false', 'demaged' => 'false', 'other'=>'false', 'other_value' => ''];

        if ($request->has('gate_status')) {
            $gateStatus = $request->gate_status;

            foreach ($gate as $key => $value) {
                if (array_key_exists($key, $gateStatus)) {
                    if ($key == 'other_value') {
                        $gate['other_value'] =$request->gate_status['other_value'];
                    }else{
                         $gate[$key] = 'true';
                    }

                }
            }
        }

        $data->gate_status = json_encode($gate) ;
        $destinationPath = 'assets/images/cable-bridge/';

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



        return view('components.map-messages',['id'=>$id,'success'=>true , 'url'=>'feeder-pillar'])
        ->with('success', 'Form Update');
} catch (\Throwable $th) {
    return $th->getMessage();
    return view('components.map-messages',['id'=>$id,'success'=>false , 'url'=>'feeder-pillar'])

        ->with('failed', 'Form Update Failed');
}
}


public function seacrh($lang ,  $q)
{

    $ba = \Illuminate\Support\Facades\Auth::user()->ba;

    $data = FeederPillar::where('ba', 'LIKE', '%' . $ba . '%')->where('id' , 'LIKE' , '%' . $q . '%')->select('id')->limit(10)->get();

    return response()->json($data, 200);
}

public function seacrhCoordinated($lang , $name)
    {
        $name = urldecode($name);
        $data = FeederPillar::where('id' , $name )->select('id', \DB::raw('ST_X(geom) as x'),\DB::raw('ST_Y(geom) as y'),)->first();

        return response()->json($data, 200);
    }
}
