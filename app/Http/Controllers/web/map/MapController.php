<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    //

    public function index(){
        $wp = DB::table('tbl_workpackage')
        ->select('id','package_name')
        ->get();

    return view('map.index',['wps'=>$wp]) ;
    }
}
