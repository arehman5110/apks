<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\LinkBox;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LinkBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = LinkBox::all();
        return view('link-box.index', ['datas' => $data]);
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
        return view('link-box.create', ['team' => $team]);
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
            $data = new LinkBox();
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $combinedDateTime;

            $data->area = $request->area;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->type = $request->type;
            $data->coordinate = $request->coordinate;
            $data->cover_status = $request->cover_status;
            $data->vandalism_status = $request->vandalism_status;
            $data->leaning_staus = $request->leaning_staus;
            $data->leaning_angle = $request->leaning_angle;
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

            $data->geom = DB::raw("ST_GeomFromText('POINT(" . $request->log . ' ' . $request->lat . ")',4326)");

            $data->save();

            return redirect()
                ->route('link-box-pelbagai-voltan.index')
                ->with('success', 'Form Intserted');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()
                ->route('link-box-pelbagai-voltan.index')
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
        $data = LinkBox::find($id);
        return view('link-box.show', ['data' => $data]);
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
        $data = LinkBox::find($id);
        return view('link-box.edit', ['data' => $data]);
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

        $currentDate = Carbon::now()->toDateString();
        $combinedDateTime = $currentDate . ' ' . $request->patrol_time;
        try {
            $data = LinkBox::find($id);
            $data->zone = $request->zone;
            $data->ba = $request->ba;
            $data->team = $request->team;
            $data->visit_date = $request->visit_date;
            $data->patrol_time = $combinedDateTime;
            $data->feeder_involved = $request->feeder_involved;
            $data->area = $request->area;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->type = $request->type;
            $data->coordinate = $request->coordinate;
            $data->gate_status = $request->gate_status;
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

            return redirect()
                ->route('link-box-pelbagai-voltan.index')
                ->with('success', 'Form Update');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()
                ->route('link-box-pelbagai-voltan.index')
                ->with('failed', 'Request Failed');
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
        //
        try {
            LinkBox::find($id)->delete();

            return redirect()
                ->route('link-box-pelbagai-voltan.index')
                ->with('success', 'Recored Removed');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('link-box-pelbagai-voltan.index')
                ->with('failed', 'Request Failed');
        }
    }
}
