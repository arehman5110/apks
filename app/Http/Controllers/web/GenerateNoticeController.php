<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenerateNoticeController extends Controller
{
    //
    public function generateNotice(Request $req){
        return view('third-party.generatenotice');
    }
}
