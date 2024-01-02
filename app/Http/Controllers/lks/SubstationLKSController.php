<?php

namespace App\Http\Controllers\lks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Substation;
use App\Traits\Filter;


class SubstationLKSController extends Controller
{
   use Filter;

    public function index(){

        return view('substation.lks');
    }

    public function getDataForLKS(Request $req){

        $result = Substation::query();

        $result = $this->filter($result , 'visit_date',$req)->where('qa_status','Accept');


        return $result->get();
}



}
