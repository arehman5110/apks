<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    //
function statsTable(Request $request){
    $bas = [
        'RAWANG',
        'KUALA LUMPUR PUSAT',
        'KLANG',
        'KUALA SELANGOR',
        'PELABUHAN KLANG',
        'BANGI',
        'CHERAS',
        'BANTING',
        'PUTRAJAYA & CYBERJAYA',
        'PETALING JAYA',
        'SEPANG',
        'PUCHONG'
    ];

  
    if ( $request->ba_name != 'null') {
        $bas = [];
            $bas = [$request->ba_name];
    }
    $from_date  = $request->from_date;
    $to_date    = $request->to_date;
    $data = [];

    foreach($bas as $key => $ba){


        $query="select   ba, COALESCE(km,0) as patroling  ,substation, feeder_pillar , tiang , link_box , cable_bridge   from
    (
        select '$ba' as ba,
                (select count(*) from tbl_substation where total_defects is not null
                 and substation_image_1 is not null and substation_image_2 is not null  and ba='$ba' and visit_date >= '$from_date'
                 AND visit_date <=  ' $to_date') as substation,
                (select count(*) from tbl_feeder_pillar where feeder_pillar_image_1 is not null and
                 feeder_pillar_image_2 is not null  and ba='$ba' and visit_date >= '$from_date'
                 AND visit_date <=  ' $to_date' ) as feeder_pillar,
                (select count(*) from tbl_savr  where ba='$ba' and pole_image_1 is not null and review_date is not null  and review_date >= '$from_date'
                AND review_date <=  ' $to_date') as tiang,
                (select count(*) from tbl_link_box  where ba='$ba' and link_box_image_1 is not null and visit_date is not null  and visit_date >= '$from_date'
                AND visit_date <=  ' $to_date') as link_box,
                (select count(*) from tbl_cable_bridge   where ba='$ba' and cable_bridge_image_1 is not null and visit_date is not null  and visit_date >= '$from_date'
                AND visit_date <=  ' $to_date') as cable_bridge,
                (select round(sum(km),2) from patroling  where ba='$ba' and vist_date is not null  and vist_date >= '$from_date'
                AND vist_date <=  ' $to_date') as km) as stats";
            $res = DB::select($query);

               $data[] =$res[0];

    }

               return $data;

               if ($data) {
            return $data;
            }

}




    function patrol_graph(Request $request)
    {
        $ba = Auth::user()->ba;
        if ($ba == ''  && $request->ba_name != 'null') {
                $ba = $request->ba_name;
        }

      $data['patrolling']       = $this->getGraphCount('patroling' , 'vist_date' , 'km' , $ba , $request );
      $data['substation']       = $this->getGraphCount('tbl_substation' , 'visit_date' , 'total_defects' , $ba, $request);
      $data['feeder_pillar']    = $this->getGraphCount('tbl_feeder_pillar' , 'visit_date' , 'total_defects' , $ba, $request );
      $data['link_box']         = $this->getGraphCount('tbl_link_box' , 'visit_date' , 'total_defects', $ba , $request );
      $data['cable_bridge']     = $this->getGraphCount('tbl_cable_bridge' , 'visit_date' , 'total_defects', $ba , $request );
      $data['tiang']            = $this->getGraphCount('tbl_savr' , 'review_date' , 'total_defects', $ba , $request);

    //   $data['suryed_patrolling']       = $this->totalGraphCount('patroling'  , $ba ,'vist_date' , $request);
      $data['suryed_substation']       = $this->totalGraphCount('tbl_substation' , $ba ,'visit_date' , $request);
      $data['suryed_feeder_pillar']    = $this->totalGraphCount('tbl_feeder_pillar' , $ba ,'visit_date' , $request );
      $data['suryed_link_box']         = $this->totalGraphCount('tbl_link_box', $ba ,'visit_date' , $request );
      $data['suryed_cable_bridge']     = $this->totalGraphCount('tbl_cable_bridge' , $ba ,'visit_date' , $request);
      $data['suryed_tiang']            = $this->totalGraphCount('tbl_savr' , $ba ,'review_date' , $request);


      return response()->json($data);


    }

    public function index(Request $request)
    {
        try {
            $ba = Auth::user()->ba;
            if ($ba == '') {
                if ($request->ba_name != 'null') {
                    $ba = $request->ba_name;
                }
            }


        //  return  $count =

     // Now $count contains the count of records that satisfy the conditions

            // ->when($ba , function ($query) use ($ba) {
            //     return $query->where('ba', $ba);
            // })
            // ->when($from_date, function ($query) use ($from_date , $date) {
            //     return $query->where($date, '>=', $from_date);
            // })
            // ->when($to_date, function ($query) use ($to_date , $date) {
            //     return $query->where($date, '<=' , $to_date);
            // });

    // return $query->get();
        // $data = [];
        //     $substation = $this->getDashboardCount('tbl_substation','visit_date', 'substation_image_1',$ba,$request);
        //     $data['substation_defects'] = $substation['sum'];
        //     $data['substation']  = $substation['count'];

        //     $feeder_pillar = $this->getDashboardCount('tbl_feeder_pillar','visit_date', 'feeder_pillar_image_1',$ba,$request);
        //     $data['fp_defects'] = $feeder_pillar['sum'];
        //     $data['feeder_pillar']  = $feeder_pillar['count'];

        //     $link_box = $this->getDashboardCount('tbl_link_box','visit_date', 'link_box_image_1',$ba,$request);
        //     $data['lb_defect'] = $link_box['sum'];
        //     $data['link_box']  = $link_box['count'];

        //     $cable_bridge = $this->getDashboardCount('tbl_cable_bridge','visit_date', 'cable_bridge_image_1',$ba,$request);
        //     $data['cb_defect'] = $cable_bridge['sum'];
        //     $data['cb_defect']  = $cable_bridge['count'];



        //     return $data;

            if ($ba != '') {
                $query = "select dig as total_notice,sup as total_supervision,km as total_km  , feeder_pillar , tiang , link_box , cable_bridge ,
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
            } else {
                $query = "select dig as total_notice,sup as total_supervision,km as total_km  , feeder_pillar , tiang , link_box , cable_bridge ,
             substation,substation_defects,fp_defects,lb as linkbox,cb as cablebridge, savr  from
            (select
            sum(case
                when notice='yes' Then 1 else 0
            end) as dig,
            (select count(*) from tbl_feeder_pillar where feeder_pillar_image_1 is not null and feeder_pillar_image_1 is not null ) as feeder_pillar,
            (select count(*) from tbl_savr  ) as tiang,
            (select count(*) from tbl_link_box ) as link_box,
            (select count(*) from tbl_cable_bridge  ) as cable_bridge,
            (select count(*) from tbl_substation where total_defects is not null and substation_image_1 is not null and substation_image_2 is not null) as substation,
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
            (SELECT sum(tinag_dimm+tiang_cracked+tiang_leaning+tiang_creepers+tiang_other+
            talian_joint+talian_ground+talian_need_rentis+talian_other+umbang_breaking+
            umbang_creepers+umbang_cracked+umbang_stay_palte+umbang_other+ipc_burn+
            ipc_other+blackbox_cracked+blackbox_other+jumper_sleeve+jumper_burn+
            jumper_other+kilat_broken+kilat_other+servis_roof+servis_won_piece+
            servis_other+pembumian_netural+pembumian_other+bekalan_dua_damage+
            bekalan_dua_other+kaki_lima_date_wire+kaki_lima_burn+kaki_lima_other)
            FROM public.savr_counts ) as savr

            ";
            }
            $data = DB::select($query);

            if ($data) {
                if ($request->ajax()) {
                    return $data[0];
                } else {
                    return view('dashboard', ['data' => $data[0]]);
                }
            } else {
                return redirect()->route('third-party-digging.index', app()->getLocale());
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()->route('third-party-digging.index', app()->getLocale());
        }
    }

    private function getDashboardCount($table , $dateColumn , $imageColumnName, $ba  , $request){


         $from_date  = $request->from_date;
         $to_date    = $request->to_date;
         $count =  [];
         $count['count'] =  DB::table($table)
                        ->whereNotNull($dateColumn)
                        ->whereNotNull($imageColumnName)
                        ->when($ba , function ($query) use ($ba) {
                            return $query->where('ba', $ba);
                        })
                        ->when($from_date, function ($query) use ($from_date , $dateColumn) {
                            return $query->where($dateColumn, '>=', $from_date);
                        })
                        ->when($to_date, function ($query) use ($to_date , $dateColumn) {
                            return $query->where($dateColumn, '<=' , $to_date);
                        })
                        ->count();

         $count['sum'] = DB::table($table)
                            ->whereNotNull($dateColumn)
                            ->whereNotNull($imageColumnName)
                            ->when($ba , function ($query) use ($ba) {
                                return $query->where('ba', $ba);
                            })
                            ->when($from_date, function ($query) use ($from_date , $dateColumn) {
                                return $query->where($dateColumn, '>=', $from_date);
                            })
                            ->when($to_date, function ($query) use ($to_date , $dateColumn) {
                                return $query->where($dateColumn, '<=' , $to_date);
                            })
                            ->sum('total_defects');

        return $count;


    }

    private function getGraphCount($table , $date , $bar , $ba , $request ){


        if ($bar != 'km') {
           $sbar = DB::raw('sum(total_defects) as bar' );
        }else{
            $sbar = "km as bar";
        }

        $from_date  = $request->from_date;
        $to_date    = $request->to_date;
        $query      = DB::table($table)
                        ->select('ba', DB::raw("$date::date as visit_date"), $sbar)
                        ->whereNotNull($date)
                        ->whereNotNull($bar)
                        ->where($bar, '<>', 0);
 
                        if ($ba) {
                            $query->where('ba', $ba);
                        }
        
                        if ($from_date) {
                            $query->where($date, '>=', $from_date);
                        }
                                
                        if ($to_date) {
                            $query->where($date, '<=' , $to_date);
                        } 

                        if ($bar != 'km') {
                            $query->groupBy('ba', DB::raw("$date::date"));
                        }

                        $query->orderBy($date , 'desc');

            return $query->get();
    }

    private function totalGraphCount($table , $ba , $date, $request){
       
 
         $from_date  = $request->from_date;
         $to_date    = $request->to_date;
         $query      = DB::table($table)
                         ->select('ba', DB::raw("$date::date as visit_date"), DB::raw('count(*) as bar' ))
                         ->whereNotNull($date)
                         ->whereNotNull('total_defects');
  
                         if ($ba) {
                             $query->where('ba', $ba);
                         }
         
                         if ($from_date) {
                             $query->where($date, '>=', $from_date);
                         }
                                 
                         if ($to_date) {
                             $query->where($date, '<=' , $to_date);
                         } 
 
                        
                             $query->groupBy('ba', DB::raw("$date::date"))
                             ->orderBy($date , 'desc');
 
             return $query->get();
    

    }

}
