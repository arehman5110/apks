<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CableBridge;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CableBridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = CableBridge::all();
        return view('cable-bridge.index',['datas'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

         $team_id = auth()->user()->id_team;
        $team = Team::find($team_id)->team_name;
        return view('cable-bridge.create',['team'=>$team]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = new CableBridge();
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $request->patrol_time;
            $data->feeder_involved = $request->feeder_involved;
            $data->area = $request->area;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;

            $data->voltage = $request->voltage;
            $data->coordinate = $request->coordinate;
            $data->pipe_staus = $request->pipe_staus;
            $data->collapsed_status = $request->collapsed_status;
            $data->vandalism_status = $request->vandalism_status;

            $data->rust_status = $request->rust_status;
            $data->bushes_status = $request->bushes_status;
            $destinationPath = 'assets/images/';

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

            $data->geom = DB::raw("ST_GeomFromText('POINT(".$request->log." ".$request->lat.")',4326)");

            $data->save();

            return redirect()
                ->route('cable-bridge.index')
                ->with('success', 'Form Intserted');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()
                ->route('cable-bridge.index')
                ->with('failed', 'Form Intserted Failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = CableBridge::find($id);
        return view('cable-bridge.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = CableBridge::find($id);
        return view('cable-bridge.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        try {

            $data = CableBridge::find($id);
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $request->patrol_time;
            $data->feeder_involved = $request->feeder_involved;
            $data->area = $request->area;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;

            $data->voltage = $request->voltage;
            $data->coordinate = $request->coordinate;
            $data->pipe_staus = $request->pipe_staus;
            $data->collapsed_status = $request->collapsed_status;
            $data->vandalism_status = $request->vandalism_status;

            $data->rust_status = $request->rust_status;
            $data->bushes_status = $request->bushes_status;
            $destinationPath = 'assets/images/';

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

            return redirect()
                ->route('cable-bridge.index')
                ->with('success', 'Form Update');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()
                ->route('cable-bridge.index')
                ->with('failed', 'Form Intserted Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            CableBridge::find($id)->delete();

            return redirect()
                ->route('cable-bridge.index')
                ->with('success', 'Recored Removed');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('cable-bridge.index')
                ->with('failed', 'Request Failed');
        }
    }
}
