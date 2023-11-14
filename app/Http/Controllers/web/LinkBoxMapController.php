<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\LinkBox;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LinkBoxMapController extends Controller
{
    //

    public function editMap($lang, $id)
    {
        $data = LinkBox::find($id);
        return $data ? view('link-box.edit-form', ['data' => $data]) : abort(404);
    }

    public function update(Request $request, $language, $id)
    {
        //

        $currentDate = Carbon::now()->toDateString();
        $combinedDateTime = $currentDate . ' ' . $request->patrol_time;
        try {
            $data = LinkBox::find($id);
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            // $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $combinedDateTime;
            $data->feeder_involved = $request->feeder_involved;

            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->type = $request->type;
            $data->coordinate = $request->coordinate;
            // $data->gate_status = $request->gate_status;
            $data->vandalism_status = $request->vandalism_status;
            $data->leaning_staus = $request->leaning_staus;
            $data->rust_status = $request->rust_status;
            $data->advertise_poster_status = $request->advertise_poster_status;
            $data->bushes_status = $request->bushes_status;
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

            $data->save();

            return view('components.map-messages', ['id' => $id, 'success' => true, 'url' => 'link-box-pelbagai-voltan'])->with('success', 'Form Update');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return view('components.map-messages', ['id' => $id, 'success' => false, 'url' => 'link-box-pelbagai-voltan'])->with('failed', 'Form Update Failed');
        }
    }
}