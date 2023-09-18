<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\WorkPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    //

    public function index(){
        $wp = DB::table('tbl_workpackage')
        ->select('id','package_name')
        ->get();

       // return response()->json($wp);
    return view('map.index',['wps'=>$wp]) ;
    }



    public function allWP(){
       return  view('map.detail',['datas'=>WorkPackage::all()]);
    }


    public function proxy($url){
       return 'The URL is: '.rawurldecode($url);;
    //    $result =  file_get_contents( $req->url);/
    //    return response()->json($result);
    }
}
