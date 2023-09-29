<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //

    public function login(Request $req){


        $validator = Validator::make($req->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 400,
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }
        $input = $req->all();


        if (  auth()->attempt(['name' => $input['username'], 'password' => $input['password']])) {
            // DB::disconnect();
            return response()
                    ->json([
                        'statusCode' => 200,
                        'success'=>true,
                        'message' => 'login success',

                    ],200);
        } else {

            return response()
                    ->json([
                        'statusCode' => 404,
                        'success'=>false,
                        'message' => 'user not found',
                    ]);
        }
    }

    public function test(){
        return "Asdas";
    }
}
