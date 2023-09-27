<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Tiang;
use App\Repositories\TiangRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiangContoller extends Controller
{

    private $tiangRepository;

    public function __construct(TiangRepository $tiaRepository)
    {
        $this->tiangRepository = $tiaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Tiang::all();

        return view('Tiang.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Tiang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            // $this->tiangRepository->store($request->all());

            $data = new Tiang();
            $data->ba = $request->ba;
            $data->name_contractor = $request->name_contractor;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->fp_name = $request->fp_name;
            $data->review_date = $request->review_date;
            $data->fp_road = $request->fp_road;
            $data->section_from = $request->section_from;
            $data->section_to = $request->section_to;
            $data->tiang_no = $request->tiang_no;

            $data->size_tiang = $request->has('size_tiang') ? json_encode($request->size_tiang) : null;
            $data->jenis_tiang = $request->has('jenis_tiang') ? json_encode($request->jenis_tiang) : null;
            $data->abc_span = $request->has('abc_span') ? json_encode($request->abc_span) : null;
            $data->pvc_span = $request->has('pvc_span') ? json_encode($request->pvc_span) : null;
            $data->bare_span = $request->has('bare_span') ? json_encode($request->bare_span) : null;

            $data->tiang_defect = $request->has('tiang_defect') ? json_encode($request->tiang_defect) : null;
            $data->talian_defect = $request->has('talian_defect') ? json_encode($request->talian_defect) : null;
            $data->umbang_defect = $request->has('umbang_defect') ? json_encode($request->umbang_defect) : null;
            $data->ipc_defect = $request->has('ipc_defect') ? json_encode($request->ipc_defect) : null;
            $data->blackbox_defect = $request->has('blackbox_defect') ? json_encode($request->blackbox_defect) : null;
            $data->jumper = $request->has('jumper') ? json_encode($request->jumper) : null;
            $data->kilat_defect = $request->has('kilat_defect') ? json_encode($request->kilat_defect) : null;
            $data->servis_defect = $request->has('servis_defect') ? json_encode($request->servis_defect) : null;
            $data->pembumian_defect = $request->has('pembumian_defect') ? json_encode($request->pembumian_defect) : null;
            $data->bekalan_dua_defect = $request->has('bekalan_dua_defect') ? json_encode($request->bekalan_dua_defect) : null;
            $data->kaki_lima_defect = $request->has('kaki_lima_defect') ? json_encode($request->kaki_lima_defect) : null;

            $data->total_defects = $request->total_defects;
            $data->planed_date = $request->planed_date;
            $data->actual_date = $request->actual_date;
            $data->remarks = $request->remarks;

            $data->tapak_condition = $request->has('tapak_condition') ? json_encode($request->tapak_condition) : null;
            $data->kawasan = $request->has('kawasan') ? json_encode($request->kawasan) : null;

            $data->jarak_kelegaan = $request->jarak_kelegaan;

            $data->talian_spec = $request->has('talian_spec') ? json_encode($request->talian_spec) : null;

            $data->arus_pada_tiang = $request->arus_pada_tiang;


            $data->geom  = DB::raw("ST_GeomFromText('POINT($request->log $request->lat)')");


            $data->save();

            return redirect()
                ->route('tiang-talian-vt-and-vr.index')
                ->with('success', 'Form Intserted');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('tiang-talian-vt-and-vr.index')
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

        $data = Tiang::find($id);
        $data['abc_span'] = json_decode($data->abc_span);
        $data['size_tiang'] = json_decode($data->size_tiang);
        $data['jenis_tiang'] = json_decode($data->jenis_tiang);
        $data['bare_span'] = json_decode($data->bare_span);
        $data['pvc_span'] = json_decode($data->pvc_span);
        $data['tiang_defect'] = json_decode($data->tiang_defect , true);
        $data['talian_defect'] = json_decode($data->talian_defect , true);
        $data['umbang_defect'] = json_decode($data->umbang_defect , true);
        $data['blackbox_defect'] = json_decode($data->blackbox_defect , true);
        $data['jumper'] = json_decode($data->jumper , true);
        $data['kilat_defect'] = json_decode($data->kilat_defect , true);
        $data['servis_defect'] = json_decode($data->servis_defect , true);
        $data['pembumian_defect'] = json_decode($data->pembumian_defect , true);
        $data['bekalan_dua_defect'] = json_decode($data->bekalan_dua_defect , true);
        $data['kaki_lima_defect'] = json_decode($data->kaki_lima_defect , true);
        $data['tapak_condition'] = json_decode($data->tapak_condition , true);
        $data['kawasan'] = json_decode($data->kawasan , true);
        $data['talian_spec'] = json_decode($data->talian_spec , true);
        $data['ipc_defect'] = json_decode($data->ipc_defect , true);



        return view('Tiang.detail',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Tiang::find($id);
        $data['abc_span'] = json_decode($data->abc_span);
        $data['size_tiang'] = json_decode($data->size_tiang);
        $data['jenis_tiang'] = json_decode($data->jenis_tiang);
        $data['bare_span'] = json_decode($data->bare_span);
        $data['pvc_span'] = json_decode($data->pvc_span);
        $data['tiang_defect'] = json_decode($data->tiang_defect , true);
        $data['talian_defect'] = json_decode($data->talian_defect , true);
        $data['umbang_defect'] = json_decode($data->umbang_defect , true);
        $data['blackbox_defect'] = json_decode($data->blackbox_defect , true);
        $data['jumper'] = json_decode($data->jumper , true);
        $data['kilat_defect'] = json_decode($data->kilat_defect , true);
        $data['servis_defect'] = json_decode($data->servis_defect , true);
        $data['pembumian_defect'] = json_decode($data->pembumian_defect , true);
        $data['bekalan_dua_defect'] = json_decode($data->bekalan_dua_defect , true);
        $data['kaki_lima_defect'] = json_decode($data->kaki_lima_defect , true);
        $data['tapak_condition'] = json_decode($data->tapak_condition , true);
        $data['kawasan'] = json_decode($data->kawasan , true);
        $data['talian_spec'] = json_decode($data->talian_spec , true);
        $data['ipc_defect'] = json_decode($data->ipc_defect , true);




        return view('Tiang.edit',['data'=>$data]);
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
        try {
            //code...

            $data =Tiang::find($id);
            $data->ba = $request->ba;
            $data->name_contractor = $request->name_contractor;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->fp_name = $request->fp_name;
            $data->review_date = $request->review_date;
            $data->fp_road = $request->fp_road;
            $data->section_from = $request->section_from;
            $data->section_to = $request->section_to;
            $data->tiang_no = $request->tiang_no;

            $data->size_tiang = $request->has('size_tiang') ? json_encode($request->size_tiang) : null;
            $data->jenis_tiang = $request->has('jenis_tiang') ? json_encode($request->jenis_tiang) : null;
            $data->abc_span = $request->has('abc_span') ? json_encode($request->abc_span) : null;
            $data->pvc_span = $request->has('pvc_span') ? json_encode($request->pvc_span) : null;
            $data->bare_span = $request->has('bare_span') ? json_encode($request->bare_span) : null;

            $data->tiang_defect = $request->has('tiang_defect') ? json_encode($request->tiang_defect) : null;
            $data->talian_defect = $request->has('talian_defect') ? json_encode($request->talian_defect) : null;
            $data->umbang_defect = $request->has('umbang_defect') ? json_encode($request->umbang_defect) : null;
            $data->ipc_defect = $request->has('ipc_defect') ? json_encode($request->ipc_defect) : null;
            $data->blackbox_defect = $request->has('blackbox_defect') ? json_encode($request->blackbox_defect) : null;
            $data->jumper = $request->has('jumper') ? json_encode($request->jumper) : null;
            $data->kilat_defect = $request->has('kilat_defect') ? json_encode($request->kilat_defect) : null;
            $data->servis_defect = $request->has('servis_defect') ? json_encode($request->servis_defect) : null;
            $data->pembumian_defect = $request->has('pembumian_defect') ? json_encode($request->pembumian_defect) : null;
            $data->bekalan_dua_defect = $request->has('bekalan_dua_defect') ? json_encode($request->bekalan_dua_defect) : null;
            $data->kaki_lima_defect = $request->has('kaki_lima_defect') ? json_encode($request->kaki_lima_defect) : null;

            $data->total_defects = $request->total_defects;
            $data->planed_date = $request->planed_date;
            $data->actual_date = $request->actual_date;
            $data->remarks = $request->remarks;

            $data->tapak_condition = $request->has('tapak_condition') ? json_encode($request->tapak_condition) : null;
            $data->kawasan = $request->has('kawasan') ? json_encode($request->kawasan) : null;

            $data->jarak_kelegaan = $request->jarak_kelegaan;

            $data->talian_spec = $request->has('talian_spec') ? json_encode($request->talian_spec) : null;

            $data->arus_pada_tiang = $request->arus_pada_tiang;

            //         $latitude =  $request->lat;

            // $longitude = $request->log;

            // $pointSql = DB::raw("ST_GeomFromText('POINT($longitude $latitude)')");

            // $data->geom = $pointSql;

            $data->update();

            return redirect()
                ->route('tiang-talian-vt-and-vr.index')
                ->with('success', 'Form Update');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('tiang-talian-vt-and-vr.index')
                ->with('failed', 'Form Update Failed');
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
        try{
            Tiang::find($id)->delete();

         return redirect()
                ->route('tiang-talian-vt-and-vr.index')
                ->with('success', 'Recored Removed');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('tiang-talian-vt-and-vr.index')
                ->with('failed', 'Request Failed');
        }
    }
}