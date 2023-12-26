<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Filter
{
    public function filter($model, $column, $request)
    {
        // model contain rest of coming query

        // column contain column name that will be [visit_date , survey_date , etc... ] every table have diffrent name of visit_date so thats why
        // we getting column name

        // request contains param like from-to date ,ba , status ect...

        $ba = $request->filled('ba') ? $request->ba : Auth::user()->ba;

        //cheeck if request has ba and ba is not empty then  add where ba = request ba
        if ($request->filled('ba')) {
            $model->where('ba', $ba);
        }

        //cheeck if request has from_date and ba is not empty then  add where  = request from_date

        if ($request->filled('from_date')) {
            $model->where($column, '>=', $request->from_date);
        }

        //cheeck if request has ba and ba is not empty then  add where ba = request ba

        if ($request->filled('to_date')) {
            $model->where($column, '<=', $request->to_date);
        }

        // if auth ba is empty then add two more conditions
        if (Auth::user()->ba == '') {
            $model->where('qa_status', 'Accept');
            // $model->whereNotNull($column);
        }

        // if request has status
        if ($request->filled('status')) {
            if ($request->status == 'unsurveyed') {
                $model->whereNull($column)->whereNull($request->image);
            } elseif ($request->status == 'surveyed_with_defects') {
                $model
                    ->whereNotNull($column)
                    ->where('total_defects', '!=', '0')
                    ->where($request->image, '!=', '');
            } elseif ($request->status == 'surveyed_without_defects') {
                $model
                    ->whereNotNull($column)
                    ->where('total_defects', '0')
                    ->where($request->image, '!=', '');
            }
        }

        // for accept and reject
        if ($request->filled('qa_status')) {
            if ($request->qa_status == 'Accept' || $request->qa_status == 'Reject') {
                $model->where('qa_status', $request->qa_status);
            }
        }
        return $model;
    }

    public function filterWithOutAccpet($model, $column, $request)
    {
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

        return $model;
    }
}

?>
