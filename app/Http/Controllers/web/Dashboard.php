<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    //

    public function index()
    {
        try {

        $ba=Auth::user()->ba;
        if(!$ba){
            $ba='%'; 
        } 
        $query="select dig as total_notice,sup as total_supervision,dis as total_km  , feeder_pillar , tiang , link_box , cable_bridge ,  substation,substation_defects from
        (select
        sum(case
            when notice='yes' Then 1 else 0
        end) as dig,
        (select count(*) from tbl_feeder_pillar where ba='$ba' and feeder_pillar_image_1 is not null and feeder_pillar_image_1 is not null ) as feeder_pillar,
        (select count(*) from tbl_savr where ba='$ba' ) as tiang,
        (select count(*) from tbl_link_box where ba='$ba') as link_box,
        (select count(*) from tbl_cable_bridge where ba='$ba' ) as cable_bridge,
        (select count(*) from tbl_substation where ba='$ba' and substation_image_1 is not null and substation_image_2 is not null) as substation,
        sum(case
            when supervision='yes' Then 1 else 0
        end) as sup
        from tbl_third_party_diging_patroling where ba='$ba') as a,
        (select km as dis from patroling where ba='$ba') as b,
        (select (hh.a+hh.b+hh.c+hh.d+hh.e+hh.f+hh.g+hh.h+hh.l+hh.m) as counts from(
            select 	
            sum(case 
                when grass_status='Yes' Then 1 else 0
            end) as a,
            sum(case 
                when tree_branches_status='Yes' Then 1 else 0
            end) as b,
            sum(case 
                when (gate_status->'locked')::text='false' Then 1 else 0
            end) as c,
            sum(case 
                when (gate_status->'demaged')::text='true' Then 1 else 0
            end) as d,
            sum(case 
                when (gate_status->'other')::text='true' Then 1 else 0
            end) as e,
            sum(case 
                when (building_status->'broken_roof')::text='true' Then 1 else 0
            end) as f,
            sum(case 
                when (building_status->'broken_gutter')::text='true' Then 1 else 0
            end) as l,
            sum(case 
                when (building_status->'broken_base')::text='true' Then 1 else 0
            end) as g,
            sum(case 
                when (building_status->'other')::text='true' Then 1 else 0
            end) as h,
            sum(case 
                when advertise_poster_status='Yes' Then 1 else 0
            end) as m	
            from tbl_substation  where ba='PETALING JAYA' and substation_image_1 is not null
            and substation_image_2 is not null 
            ) as hh) as substation_defects";
       // return $query; 
        $data = DB::select($query);

        //  return $data[0];
        if($data){
        return view('dashboard',['data'=>$data[0]]);
        }else{
            return redirect()->route('third-party-digging.index',app()->getLocale());
        } 

    } catch (Exception $error) {
        //return $error->getMessage();
      //  return $th;
       return redirect()->route('third-party-digging.index',app()->getLocale());
    }
    }
}
