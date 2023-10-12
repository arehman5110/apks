<?php

namespace App\Http\Controllers\web\map;

use App\Http\Controllers\Controller;
use App\Models\Road;
use App\Models\WorkPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    //

    public function index(){
        $wp = DB::table('tbl_workpackage')
        ->select('id','package_name')
        ->get();


    //    return response()->json($wp);
    return view('map.index',['wps'=>$wp]) ;
    }



    public function allWP(){
        $ba = Auth::user()->ba ;
        $datas = WorkPackage::where('ba', 'LIKE', '%' . $ba . '%')->get();

        $roads = [];


       return  view('map.detail',['datas'=>$datas,'roads'=>$roads]);
    }

    public function getRoadsDetails($wpID){

        return Road::where('id_workpackage',$wpID)->select('id', 'road_name', 'km','actual_km','fidar')->get();

    }


    public function proxy($url){

       $result =  file_get_contents(rawurldecode($url));
       return response()->json($result);
    }

    public function teswtpagination( Request $request , $id , $status){
        if ($status == 'Patroled') {
            $roads = Road::where('id_workpackage',$id)->where('actual_km' , '!=' , null)->select('id','road_name','actual_km','km')->paginate(10);
        }else{
             $roads = Road::where('id_workpackage',$id)->where('actual_km' , null)->select('id','road_name','actual_km','km')->paginate(10);

        }



        return view('map.pagination.roads-pagination',['roads'=>$roads])->render();


    }
}
