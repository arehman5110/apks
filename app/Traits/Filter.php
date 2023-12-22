<?php



namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Filter
{
    public function filter($model , $column , $request ){
        $ba = $request->filled('ba') ? $request->ba : Auth::user()->ba;
        

        if ($request->filled('ba')) {
            $model->where('ba', $ba);
        }

        if ($request->filled('from_date')) {
            $model->where($column, '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $model->where($column, '<=', $request->to_date);
        }
        if (Auth::user()->ba == '') {
           $model->where('qa_status' , 'Accept');
        }
        if ($request->filled('status')) {
            if($request->status == 'unsurveyed'){
                $model->whereNull($column)->whereNull($request->image); 
            }elseif($request->status == 'surveyed_with_defects'){
                $model->whereNotNull($column)->where('total_defects' ,'!=' , '0')->where($request->image , '!=' , ''); 
            }elseif($request->status == 'surveyed_without_defects'){
                $model->whereNotNull($column)->where('total_defects' , '0')->where($request->image , '!=' , ''); 
            }
        }

        if ($request->filled('qa_status')) {
            if ($request->qa_status == 'Accept' || $request->qa_status == 'Reject') {
      
                $model->where('qa_status' , $request->qa_status);
            }
        }
        return $model;
    }
}




?>