<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    //

    public function index()
    {
        $data = DB::select("select dig as total_notice,sup as total_supervision,dis as total_km from
        (select
        sum(case
            when notice='yes' Then 1 else 0
        end) as dig,
        sum(case
            when supervision='yes' Then 1 else 0
        end) as sup
        from tbl_third_party_diging_patroling) as a,
        (select sum(st_length(geom::geography)/1000) as dis from
         tbl_roads where road_name in (select road_name from tbl_third_party_diging_patroling)) as b");

        return $data;
    }
}
