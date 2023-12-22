<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeederPillar;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $ba = $request->filled('ba') ? $request->ba : Auth::user()->ba;
            $result = FeederPillar::query();

            if ($request->filled('ba')) {
                $result->where('ba', $ba);
            }

            if ($request->filled('from_date')) {
                $result->where('visit_date', '>=', $request->from_date);
            }

            if ($request->filled('to_date')) {
                $result->where('visit_date', '<=', $request->to_date);
            }

            $result->when(true, function ($query) {
                return $query->select(
                    'id',
                    'ba', 
                    'visit_date',
                    DB::raw("CASE WHEN (gate_status->>'unlocked')::text='true' THEN 'Yes' ELSE 'No' END as unlocked"),
                    DB::raw("CASE WHEN (gate_status->>'demaged')::text='true' THEN 'Yes' ELSE 'No' END as demaged"),
                    DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN 'Yes' ELSE 'No' END as other_gate"),
                    'vandalism_status',
                    'leaning_staus',
                    'rust_status',
                    'advertise_poster_status',
                    'total_defects'
                );
            }); 

            return datatables()->of($result->get())->addColumn('feeder_pillar_id', function ($row) {
                    
                return "FP-" .$row->id;
            })->make(true);
        }
        return view('feeder-pillar.index');
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
        return view('feeder-pillar.create', ['team' => $team]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentDate = Carbon::now()->toDateString();
        $combinedDateTime = $currentDate . ' ' . $request->patrol_time;

        try {

            $defects = [];
            $defects =['leaning_staus','vandalism_status','advertise_poster_status','rust_status'];

            $total_defects =0;

            $data = new FeederPillar();
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $combinedDateTime;

            $data->size = $request->size;
            $data->coordinate = $request->coordinate;
            $user = Auth::user()->id;

            $data->created_by = $user;
            $data->leaning_angle = $request->leaning_angle;

            $gate = [ 'unlocked' => 'false', 'demaged' => 'false', 'other'=>'false'];

            if ($request->has('gate_status')) {
                $gateStatus = $request->gate_status;

                foreach ($gate as $key => $value) {

                    if (array_key_exists($key, $gateStatus)) {
                        $gate[$key] = true;
                        $total_defects++;
                    }else{
                        $gate[$key] = false;
                    }

                }
                $gate['other_value'] = $request->gate_status['other_value'];
            }
            $data->gate_status = json_encode($gate) ;
            foreach ($defects as  $value) {
                $data->{$value} = $request->{$value};
               $request->has($value)&& $request->{$value} == 'Yes' ? $total_defects++ : '';
            }
            $data->total_defects = $total_defects;


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

            $data->geom = DB::raw("ST_GeomFromText('POINT(" . $request->log . ' ' . $request->lat . ")',4326)");

            $data->save();

            return redirect()
                ->route('feeder-pillar.index',app()->getLocale())
                ->with('success', 'Form Intserted');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('feeder-pillar.index')
                ->with('failed', 'Form Intserted Failed',app()->getLocale());
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
        $data = FeederPillar::find($id);
        if ($data) {
            $data->gate_status = json_decode($data->gate_status);


            return view('feeder-pillar.show', ['data' => $data ,'disabled'=>true]);
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
        $data = FeederPillar::find($id);
        if ($data) {
            $data->gate_status = json_decode($data->gate_status);


            return view('feeder-pillar.edit', ['data' => $data , 'disabled'=>false]);
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
    public function update(Request $request,$language,$id)
    {
        try {

            $defects = [];
            $defects =['leaning_staus','vandalism_status','advertise_poster_status','rust_status'];

            $total_defects =0;
            $currentDate = Carbon::now()->toDateString();
            $combinedDateTime = $currentDate . ' ' . $request->patrol_time;

            $data = FeederPillar::find($id);
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            // $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $combinedDateTime;
            $user = Auth::user()->id;

            $data->updated_by = $user;

            $data->size = $request->size;
            $data->coordinate = $request->coordinate;
            $data->leaning_angle = $request->leaning_angle;

            $gate = [ 'unlocked' => 'false', 'demaged' => 'false', 'other'=>'false'];

            if ($request->has('gate_status')) {
                $gateStatus = $request->gate_status;

                foreach ($gate as $key => $value) {

                    if (array_key_exists($key, $gateStatus)) {
                        $gate[$key] = true;
                        $total_defects++;
                    }else{
                        $gate[$key] = false;
                    }

                }
                $gate['other_value'] = $request->gate_status['other_value'];
            }
            $data->gate_status = json_encode($gate) ;

            foreach ($defects as  $value) {
                $data->{$value} = $request->{$value};
               $request->has($value)&& $request->{$value} == 'Yes' ? $total_defects++ : '';
            }
            $data->total_defects = $total_defects;
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

            return redirect()
                ->route('feeder-pillar.index',app()->getLocale())
                ->with('success', 'Form Intserted');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('feeder-pillar.index',app()->getLocale())
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
            FeederPillar::find($id)->delete();

            return redirect()
                ->route('feeder-pillar.index',app()->getLocale())
                ->with('success', 'Recored Removed');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('feeder-pillar.index',app()->getLocale())
                ->with('failed', 'Request Failed');
        }
    }
}
