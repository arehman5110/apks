<?php

namespace App\Repositories;

use App\Models\Tiang;

class TiangRepository{

    public function store(array $request){
        $data = new Tiang();
            // $data->ba = $request->ba;
            // $data->name_contractor = $request->name_contractor;
            // $data->start_date = $request->start_date;
            // $data->end_date = $request->end_date;
            // $data->fp_name = $request->fp_name;
            // $data->review_date = $request->review_date;
            // $data->fp_road = $request->fp_road;
            // $data->section_from = $request->section_from;
            // $data->section_to = $request->section_to;
            // $data->tiang_no = $request->tiang_no;

            // $data->size_tiang = $request->has('size_tiang') ? json_encode($request->size_tiang) : null;
            // $data->jenis_tiang = $request->has('jenis_tiang') ? json_encode($request->jenis_tiang) : null;
            // $data->abc_span = $request->has('abc_span') ? json_encode($request->abc_span) : null;
            // $data->pvc_span = $request->has('pvc_span') ? json_encode($request->pvc_span) : null;
            // $data->bare_span = $request->has('bare_span') ? json_encode($request->bare_span) : null;

            // $data->tiang_defect = $request->has('tiang_defect') ? json_encode($request->tiang_defect) : null;
            // $data->talian_defect = $request->has('talian_defect') ? json_encode($request->talian_defect) : null;
            // $data->umbang_defect = $request->has('umbang_defect') ? json_encode($request->umbang_defect) : null;
            // $data->ipc_defect = $request->has('ipc_defect') ? json_encode($request->ipc_defect) : null;
            // $data->blackbox_defect = $request->has('blackbox_defect') ? json_encode($request->blackbox_defect) : null;
            // $data->jumper = $request->has('jumper') ? json_encode($request->jumper) : null;
            // $data->kilat_defect = $request->has('kilat_defect') ? json_encode($request->kilat_defect) : null;
            // $data->servis_defect = $request->has('servis_defect') ? json_encode($request->servis_defect) : null;
            // $data->pembumian_defect = $request->has('pembumian_defect') ? json_encode($request->pembumian_defect) : null;
            // $data->bekalan_dua_defect = $request->has('bekalan_dua_defect') ? json_encode($request->bekalan_dua_defect) : null;
            // $data->kaki_lima_defect = $request->has('kaki_lima_defect') ? json_encode($request->kaki_lima_defect) : null;

            // $data->total_defects = $request->total_defects;
            // $data->planed_date = $request->planed_date;
            // $data->actual_date = $request->actual_date;
            // $data->remarks = $request->remarks;

            // $data->tapak_condition = $request->has('tapak_condition') ? json_encode($request->tapak_condition) : null;
            // $data->kawasan = $request->has('kawasan') ? json_encode($request->kawasan) : null;

            // $data->jarak_kelegaan = $request->jarak_kelegaan;

            // $data->talian_spec = $request->has('talian_spec') ? json_encode($request->talian_spec) : null;

            // $data->arus_pada_tiang = $request->arus_pada_tiang;

            //         $latitude =  $request->lat;

            // $longitude = $request->log;

            // $pointSql = DB::raw("ST_GeomFromText('POINT($longitude $latitude)')");

            // $data->geom = $pointSql;

            // $data->save();

    }

}


