<?php

namespace App\Http\Controllers\web\tnbes;

use App\Http\Controllers\Controller;
use App\Models\WorkPackage;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    //

    public function sendToTnbes($id){
        WorkPackage::find($id)->update(['wp_status'=>'pending']);
        return redirect()->back()->with('success','Successfully send to SBUM');
    }
}
