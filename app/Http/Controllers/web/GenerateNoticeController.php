<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\ThirdPartyDiging;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateNoticeController extends Controller
{
    //
    public function generateNotice($id){
        return view('third-party.generatenotice');
    }
    
    function index() : View {
        $ba = Auth::user()->ba;
        $datas = ThirdPartyDiging::where('ba','LIKE', '%' . $ba . '%')->where('notice','yes')->get();

        return view('notice.index',['datas'=>$datas]);
        
    }
}
