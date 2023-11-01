<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CableBridge;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CableBridgeMapController extends Controller
{
    //

    public function editMap($lang, $id)
    {

        $data = CableBridge::find($id);
        return $data ?  view('cable-bridge.edit-form', ['data' => $data]) : abort(404);

    }

    public function update(Request $request, $language, $id)
    {
        //
        

        try {
            $currentDate = Carbon::now()->toDateString();
            $combinedDateTime = $currentDate . ' ' . $request->patrol_time;

            $data = CableBridge::find($id);
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            // $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $combinedDateTime;
            $data->feeder_involved = $request->feeder_involved;

            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;

            $data->voltage = $request->voltage;
            // $data->coordinate = $request->coordinate;
            $data->pipe_staus = $request->pipe_staus;
            $data->collapsed_status = $request->collapsed_status;
            $data->vandalism_status = $request->vandalism_status;

            $data->rust_status = $request->rust_status;
            $data->bushes_status = $request->bushes_status;
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

            $data->save();



            return view('components.map-messages',['id'=>$id,'success'=>true , 'url'=>'cable-bridge'])
            ->with('success', 'Form Update');
    } catch (\Throwable $th) {
        return $th->getMessage();
        return view('components.map-messages',['id'=>$id,'success'=>false , 'url'=>'cable-bridge'])

            ->with('failed', 'Form Update Failed');
    }
    }

}
