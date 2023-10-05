<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Road;
use App\Models\Team;
use App\Models\WorkPackage;
use Illuminate\Http\Request;

class PatrollingController extends Controller
{
    //

    public function create(){
        $team_id = auth()->user()->id_team;
        $team = Team::find($team_id)->team_name;
        $wp = WorkPackage::all();

        return view('patrolling.edit-road', ['team' => $team, 'wp' => $wp]);
    }
    public function updateRoads(Request $request){

        
    }
}

