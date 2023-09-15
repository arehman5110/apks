<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\FeederPillar;
use App\Models\Substation;
use App\Models\ThirdPartyDiging;
use Illuminate\Http\Request;

class uploadImagesContoller extends Controller
{

    public function uploadImages(Request $req,  $modelName,  $id)
    {
        $success = false;
        $error = null;


        $modelClass = "App\\Models\\$modelName";
        try {
        $data = $modelClass::find($id);

        if ($data) {
            $destinationPath = 'assets/images/';


                foreach ($req->all() as $key => $file) {
                    // Check if the input is a file and it is valid
                    if ($req->hasFile($key) && $req->file($key)->isValid()) {
                        $uploadedFile = $req->file($key);
                        $img_ext = $uploadedFile->getClientOriginalExtension();
                        $filename = $key . '-' . strtotime(now()) . '.' . $img_ext;
                        $uploadedFile->move($destinationPath, $filename);
                        $data->{$key} = $destinationPath . $filename;
                    }
                }
                $data->save();

                $message = 'Images uploaded successfully';
                $success = true;
                $status = 200;

        } else {
            $message = 'Record not found';
            $status = 404;
        }
    } catch (\Throwable $th) {
        $message = 'Server-side error';
        $status = 500;
        $error = $th->getMessage();
    }

        return response()->json([
            'success' => $success,
            'message' => $message,
            'error' => $error,
        ], $status);
    }



}
