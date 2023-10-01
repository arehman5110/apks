<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\web\admin\TeamController;
use App\Http\Controllers\web\admin\TeamUsersController;
use App\Http\Controllers\web\CableBridgeController;
use App\Http\Controllers\web\excel\CableBridgeExcelController;
use App\Http\Controllers\web\excel\DigingExcelController;
use App\Http\Controllers\web\excel\TiangExcelController;
use App\Http\Controllers\web\LinkBoxController;
use App\Http\Controllers\web\map\GeneratePDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\map\MapController;
use App\Http\Controllers\web\map\RoadController;
use App\Http\Controllers\web\map\WPController;
use App\Http\Controllers\web\TiangContoller;
use App\Http\Controllers\web\tnbes\StatusController;
use App\Http\Controllers\web\ThirdPartyDiggingController;
use App\Http\Controllers\web\SubstationController;
use App\Http\Controllers\web\FPController;



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

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




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








/// tiang

Route::resource('tiang-talian-vt-and-vr',TiangContoller::class);
Route::get('tiang-test',[TiangExcelController::class,'generateDigingExcel']);
Route::view('/tiang-talian-vt-and-vr-tiang','Tiang.map');


//// Link Box
Route::resource('link-box-pelbagai-voltan',LinkBoxController::class);
Route::get('generate-link-box-excel',[CableBridgeExcelController::class,'generateCableBridgeExcel'])->name('generate-link-box-excel');
Route::view('/link-box-pelbagai-voltan-map','link-box.map');

//// Cable Bridge

Route::resource('cable-bridge',CableBridgeController::class);
Route::get('generate-cable-bridge-excel',[CableBridgeExcelController::class,'generateCableBridgeExcel'])->name('generate-cable-bridge-excel');
Route::view('/cable-bridge-map','cable-bridge.map');

////third party digging routes
Route::resource('third-party-digging',ThirdPartyDiggingController::class);
Route::get('generate-third-party-digging-excel',[CableBridgeExcelController::class,'generateCableBridgeExcel'])->name('generate-third-party-digging-excel');


////substation routes
Route::resource('substation',SubstationController::class);
Route::view('/substation-map','substation.map');

////feeder-piller routes
Route::resource('feeder-pillar',FPController::class);
Route::view('/feeder-pillar-map','feeder-pillar.map');

//// Admin side
Route::prefix('admin')->group(function () {
    Route::resource('/team',TeamController::class);
    Route::resource('team-users',TeamUsersController::class);
});


Route::view('/dashboard', 'dashboard');

Route::view('/map-2','map');



});

require __DIR__ . '/auth.php';

