<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Substation;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SubstationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ba = Auth::user()->ba ;
        $data = Substation::where('ba', 'LIKE', '%' . $ba . '%')->get();
        return view('substation.index',['datas'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team_id = auth()->user()->id_team;
        $team = Team::find($team_id)->team_name;
        return view('substation.create',['team'=>$team]);
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
            $currentDate = Carbon::now()->toDateString();
            $combinedDateTime = $currentDate . ' ' . $request->patrol_time;
            $data = new Substation();
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time =$combinedDateTime;

            $data->voltage = $request->voltage;
            $data->name = $request->name;
            $data->type = $request->type;
            $data->coordinate = $request->coordinate;

            $data->grass_status = $request->grass_status;
            $data->tree_branches_status = $request->tree_branches_status;

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


            $building = ['broken_roof' => 'false', 'broken_gutter' => 'false', 'broken_base' => 'false', 'other'=>'false', 'other_value' => ''];

            if ($request->has('building_status')) {
                $buildingStatus = $request->building_status;

                foreach ($building as $key => $value) {
                    if (array_key_exists($key, $buildingStatus)) {
                        if ($key == 'other_value') {
                            $building['other_value'] =$request->building_status['other_value'];
                        }else{
                             $building[$key] = 'true';
                        }

                    }
                }
            }
            $data->building_status = json_encode($building);


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

            $data->geom = DB::raw("ST_GeomFromText('POINT(".$request->log." ".$request->lat.")',4326)");

            $data->save();

            return redirect()
                ->route('substation.index', app()->getLocale())
                ->with('success', 'Form Intserted');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('substation.index', app()->getLocale())
                ->with('failed', 'Form Intserted Failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($language,$id)
    {
        $data = Substation::find($id);
        if ($data) {
            $data->gate_status = json_decode($data->gate_status);
            $data->building_status = json_decode($data->building_status);

            return view('substation.show',['data'=>$data]);
        }
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language,$id)
    {
        $data = Substation::find($id);
        if ($data) {
            $data->gate_status = json_decode($data->gate_status);
            $data->building_status = json_decode($data->building_status);
            // return $data->gate_status->locked;

            return view('substation.edit',['data'=>$data]);
        }
        return abort('404');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $language, $id)
    {
        try {
            $currentDate = Carbon::now()->toDateString();
            $combinedDateTime = $currentDate . ' ' . $request->patrol_time;

            $data = Substation::find($id);
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time =$combinedDateTime;

            $data->voltage = $request->voltage;
            $data->name = $request->name;
            $data->type = $request->type;
            $data->coordinate = $request->coordinate;
            $data->grass_status = $request->grass_status;
            $data->tree_branches_status = $request->tree_branches_status;

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


            $building = ['broken_roof' => 'false', 'broken_gutter' => 'false', 'broken_base' => 'false', 'other'=>'false', 'other_value' => ''];

            if ($request->has('building_status')) {
                $buildingStatus = $request->building_status;

                foreach ($building as $key => $value) {
                    if (array_key_exists($key, $buildingStatus)) {
                        if ($key == 'other_value') {
                            $building['other_value'] =$request->building_status['other_value'];
                        }else{
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

            return redirect()
                ->route('substation.index',app()->getLocale())
                ->with('success', 'Form Update');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()
                ->route('substation.index',app()->getLocale())
                ->with('failed', 'Form Intserted Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($language,$id)
    {
        try {
            Substation::find($id)->delete();

            return redirect()
                ->route('substation.index',app()->getLocale())
                ->with('success', 'Recored Removed');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('substation.index',app()->getLocale())
                ->with('failed', 'Request Failed');
        }
    }

}
