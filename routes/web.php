<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\web\excel\DigingExcelController;
use App\Http\Controllers\web\map\GeneratePDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\map\MapController;
use App\Http\Controllers\web\map\RoadController;
use App\Http\Controllers\web\map\WPController;
use App\Http\Controllers\web\tnbes\StatusController;
use App\Models\Road;
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
Route::get('/proxy/{url}',[MapController::class,'proxy']);

Route::post('/save-work-package',[App\Http\Controllers\web\map\WPController::class,"saveWorkPackage"]);
Route::post('/save-road',[App\Http\Controllers\web\map\RoadController::class,"saveRoad"]);


Route::post('/get-raod-info',[App\Http\Controllers\web\map\WPController::class,"getRoadInfo"]);
Route::post('/get-ba-info',[App\Http\Controllers\web\map\WPController::class,"getBaInfo"]);
Route::get('/get-work-package/{ba}/{zone}',[App\Http\Controllers\web\map\WPController::class,"selectWP"]);
Route::get('/getStats/{wp}',[App\Http\Controllers\web\map\WPController::class,"getStats"]);


Route::get('/send-to-tnbes/{id}',[StatusController::class,'sendToTnbes']);
Route::get('/generate-third-party-diging-excel/{id}',[DigingExcelController::class,'generateDigingExcel']);
Route::get("/get-work-package-detail/{id}",[WPController::class,'detail']);

Route::get('/remove-road/{id}',[RoadController::class,'removeRoad']);
Route::get('/remove-work-package/{id}',[WPController::class,'removeWP']);

Route::get('/generate-third-party-pdf/{id}',[GeneratePDFController::class,'generatePDF']);

Route::view('/pencawang','pencawang.create');
Route::view('/tiang','Tiang.create');
Route::view('/feeder-pillar','feeder-pillar.create');
Route::view('/link-box','link-box.create');
Route::view('/cable-bridge','cable-bridge.create');

Route::view('/savr-bridge','savr.create');



require __DIR__ . '/auth.php';

