<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_login;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //

    public function login(Request $req){

        $input = $req->all();


        if (  auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
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
