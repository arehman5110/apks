<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class Dashboard extends Controller
{
    //

    public function index()
    {
        try {


        $data = DB::select("select dig as total_notice,sup as total_supervision,dis as total_km  , feeder_pillar , tiang , link_box , cable_bridge ,  substation from
        (select
        sum(case
            when notice='yes' Then 1 else 0
        end) as dig,
        (select count(*) from tbl_feeder_pillar ) as feeder_pillar,

        (select count(*) from tbl_savr ) as tiang,


        (select count(*) from tbl_link_box ) as link_box,
        (select count(*) from tbl_cable_bridge ) as cable_bridge,
        (select count(*) from tbl_substation ) as substation,

        sum(case
            when supervision='yes' Then 1 else 0
        end) as sup
        from tbl_third_party_diging_patroling) as a,
        (select sum(st_length(geom::geography)/1000) as dis from
         tbl_roads where road_name in (select road_name from tbl_third_party_diging_patroling)) as b");

        //  return $data[0];
        return view('dashboard',['data'=>$data[0]]);


    } catch (\Throwable $th) {
       return redirect()->route('third-party-digging.index',app()->getLocale());
    }
    }
}
