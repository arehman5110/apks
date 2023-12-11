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
       if($ba!=''){
        $query="select dig as total_notice,sup as total_supervision,km as total_km  , feeder_pillar , tiang , link_box , cable_bridge ,  substation,substation_defects,fp_defects from
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
        (SELECT sum(grass+treebranches+gate_loc+gate_demage+gate_other+broken_roof+broken_gutter+broken_base+building_other+poster_status)
        FROM public.substation_defects_counts  where ba='$ba'
            ) as substation_defects,
        (SELECT sum(gate_locked+gate_damage+gate_other+vandlism+leaning+rust+poster_status)
            FROM public.feeder_pillar_defects_counts where ba='$ba') as fp_defects,
            (select sum(km) from patroling where ba='$ba') as km
            ";

        }else{
            $query="select dig as total_notice,sup as total_supervision,km as total_km  , feeder_pillar , tiang , link_box , cable_bridge ,  substation,substation_defects,fp_defects from
            (select
            sum(case
                when notice='yes' Then 1 else 0
            end) as dig,
            (select count(*) from tbl_feeder_pillar where feeder_pillar_image_1 is not null and feeder_pillar_image_1 is not null ) as feeder_pillar,
            (select count(*) from tbl_savr  ) as tiang,
            (select count(*) from tbl_link_box ) as link_box,
            (select count(*) from tbl_cable_bridge  ) as cable_bridge,
            (select count(*) from tbl_substation where substation_image_1 is not null and substation_image_2 is not null) as substation,
            sum(case
                when supervision='yes' Then 1 else 0
            end) as sup
            from tbl_third_party_diging_patroling ) as a,
            (select km as dis from patroling ) as b,
            (SELECT sum(grass+treebranches+gate_loc+gate_demage+gate_other+broken_roof+broken_gutter+broken_base+building_other+poster_status)
            FROM public.substation_defects_counts) as substation_defects,
            (SELECT sum(gate_locked+gate_damage+gate_other+vandlism+leaning+rust+poster_status)
            FROM public.feeder_pillar_defects_counts) as fp_defects,
            (select sum(km) from patroling) as km
            ";
        }   
     //   return $query; 
        $data = DB::select($query);

         // return $data;
        if($data){
        return view('dashboard',['data'=>$data[0]]);
        }else{
         return redirect()->route('third-party-digging.index',app()->getLocale());
        } 

    } catch (Exception $error) {
       // return $error->getMessage();
      //  return $th;
       return redirect()->route('third-party-digging.index',app()->getLocale());
    }
    }
}
