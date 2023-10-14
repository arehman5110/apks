<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Road;
use App\Models\Team;
use App\Models\WorkPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PatrollingController extends Controller
{
    //

    public function create()
    {
        $team_id = auth()->user()->id_team;
        $team = Team::find($team_id)->team_name;
        $wp = WorkPackage::all();

        return view('patrolling.edit-road', ['team' => $team, 'wp' => $wp]);
    }
    public function updateRoads(Request $request)
    {
        try {
            $currentDate = Carbon::now()->toDateString();
            $time_petrol = $currentDate . ' ' . $request->time_petrol;

            $road = Road::find($request->road_id);
            $road->road_name = $request->road_name;
            $road->date_patrol = $request->date_patrol;
            $road->fidar = $request->fidar;
            $road->name_project = $request->name_project;
            $road->time_petrol = $time_petrol;
            $road->actual_km = $request->actual_km;
            $road->total_digging = $request->total_digging;
            $road->total_notice = $request->total_notice;
            $road->total_supervision = $request->total_supervision;
            $road->update();

            return redirect()->route('get-all-work-packages',app()->getLocale())
                ->with('success', 'Request Success');
        } catch (\Throwable $th) {
            return redirect()->route('get-all-work-packages',app()->getLocale())
                ->with('failed', 'Request Failed');
        }
    }

    public function editRoad($language,$id)
    {
        try {
            $road = Road::find($id);
            return $road ? view('patrolling.update-road', ['road' => $road]) : abort(404);
        } catch (\Throwable $th) {
            return redirect('/get-all-work-packages')
                ->with('failed', 'Request Failed');
        }
    }

    public function getRoads($language,$id)
    {
        $roads = Road::where('id_workpackage', $id)
            ->select('id', 'road_name')
            ->get();

        return $roads;
    }

    public function getRoadsByID($language,$id)
    {
        $road = Road::where('id', $id)
            ->select('id', 'road_name', 'km', 'date_patrol', 'time_petrol', 'name_project', 'actual_km', 'fidar', 'total_digging', 'total_notice', 'total_supervision')
            ->first();
        $road->time_petrol = date('H:i:s', strtotime($road->time_petrol));
        return $road;
    }

    public function getRoad($language,$id)
    {
        $road = Road::where('id', $id)
            ->with('workPackage')

            ->first();
        $road->time_petrol = date('H:i:s', strtotime($road->time_petrol));
        return view('patrolling.show-road', ['road' => $road]);
    }
}
