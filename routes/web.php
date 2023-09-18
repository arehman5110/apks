<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\map\MapController;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Gd\Commands\RotateCommand;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/map-1',[MapController::class,'index']);
Route::get('/get-all-work-packages',[MapController::class,'allWP']);

Route::post('/save-work-package',[App\Http\Controllers\web\map\WPController::class,"saveWorkPackage"]);
Route::post('/save-road',[App\Http\Controllers\web\map\RoadController::class,"saveRoad"]);


Route::post('/get-raod-info',[App\Http\Controllers\web\map\WPController::class,"getRoadInfo"]);
Route::post('/get-ba-info',[App\Http\Controllers\web\map\WPController::class,"getBaInfo"]);
Route::get('/get-work-package/{id}',[App\Http\Controllers\web\map\WPController::class,"selectWP"]);



require __DIR__ . '/auth.php';

