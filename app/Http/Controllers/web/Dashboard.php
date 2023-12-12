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
        $query="select dig as total_notice,sup as total_supervision,km as total_km  , feeder_pillar , tiang , link_box , cable_bridge ,  
        substation,substation_defects,fp_defects,lb as linkbox,cb as cablebridge,savr from
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
            (select round(sum(km),2) from patroling where ba='$ba') as km,
         (select sum(vandalism_status)+sum(leaning_status)+sum(rust_status)+sum(advertise_poster_status)+sum(bushes_status)+sum(cover_status) from 	tbl_link_box_counts where ba='$ba') as lb,
         (SELECT sum(vandalism_status+pipe_status+collapsed_status+rust_status+bushes_status) FROM public.cable_bridge_counts where ba='$ba') as cb,
         (SELECT sum(tinag_dimm+tiang_cracked+tiang_leaning+tiang_creepers+tiang_other+ 
         talian_joint+talian_ground+talian_need_rentis+talian_other+umbang_breaking+ 
         umbang_creepers+umbang_cracked+umbang_stay_palte+umbang_other+ipc_burn+ 
         ipc_other+blackbox_cracked+blackbox_other+jumper_sleeve+jumper_burn+ 
         jumper_other+kilat_broken+kilat_other+servis_roof+servis_won_piece+
         servis_other+pembumian_netural+pembumian_other+bekalan_dua_damage+ 
         bekalan_dua_other+kaki_lima_date_wire+kaki_lima_burn+kaki_lima_other)
         FROM public.savr_counts where ba='$ba') as savr   
            ";

        }else{
            $query="select dig as total_notice,sup as total_supervision,km as total_km  , feeder_pillar , tiang , link_box , cable_bridge , 
             substation,substation_defects,fp_defects,lb as linkbox,cb as cablebridge, savr  from
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
            (select round(sum(km),2) from patroling) as km,
            (select sum(vandalism_status)+sum(leaning_status)+sum(rust_status)+sum(advertise_poster_status)+sum(bushes_status)+sum(cover_status) from 	tbl_link_box_counts ) as lb,
            (SELECT sum(vandalism_status+pipe_status+collapsed_status+rust_status+bushes_status) FROM public.cable_bridge_counts) as cb,
            SELECT sum(tinag_dimm+tiang_cracked+tiang_leaning+tiang_creepers+tiang_other+ 
            talian_joint+talian_ground+talian_need_rentis+talian_other+umbang_breaking+ 
            umbang_creepers+umbang_cracked+umbang_stay_palte+umbang_other+ipc_burn+ 
            ipc_other+blackbox_cracked+blackbox_other+jumper_sleeve+jumper_burn+ 
            jumper_other+kilat_broken+kilat_other+servis_roof+servis_won_piece+
            servis_other+pembumian_netural+pembumian_other+bekalan_dua_damage+ 
            bekalan_dua_other+kaki_lima_date_wire+kaki_lima_burn+kaki_lima_other) as savr
            FROM public.savr_counts  

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
 
    } catch (\Throwable $th) {
       // return $error->getMessage();
      //  return $th;
       return redirect()->route('third-party-digging.index',app()->getLocale());
    }
    }
}
