<?php

namespace App\Http\Controllers\lks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 


class RemoveLKSController extends Controller
{
    //

    public function removeFiles(Request $req)  
    {
        if ($req->has('fileName') && $req->fileName != '') 
        {
            if (file_exists(public_path('/temp/'.$req->fileName))) 
            {
                File::delete(public_path('/temp/'.$req->fileName));
                return 'success';
            }
        }
    }
}
