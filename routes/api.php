<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\DBController;
use App\Http\Controllers\api\uploadImagesContoller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/database/GetResults',[DBController::class,'GetResults']);

Route::post("/database/insert",[DBController::class,'insert']);
Route::post("/database/update",[DBController::class,'update']);


Route::post('/login',[App\Http\Controllers\api\LoginController::class,"login"]);

Route::post('/upload-site-images/{model}/{id}',[uploadImagesContoller::class,"uploadImages"]);
