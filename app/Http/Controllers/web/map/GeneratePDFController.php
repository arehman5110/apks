<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\WorkPackage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneratePDFController extends Controller
{
    //

    public function generatePDF($language,$id)  {
        $data = DB::select("select  * from tbl_third_party_diging_patroling where id =  $id");
        $proj = WorkPackage::find($data[0]->workpackage_id);
        // return $data;
              return view('map.previewPDF',['data'=>$data[0], 'proj'=>$proj]);
    }
}
