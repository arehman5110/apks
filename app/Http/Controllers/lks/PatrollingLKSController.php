<?php

namespace App\Http\Controllers\lks;

use App\Http\Controllers\Controller;
use App\Models\Patroling;
use App\Traits\Filter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF; 
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\returnSelf;

class PatrollingLKSController extends Controller
{
    //
    use Filter;
    public function index(){

        return view('patrolling.lks');
    }

    public function genet(Request $req)
    {

      
        $result = Patroling::query(); 
        $result = $this->filter($result , 'visit_date',$req)->whereNotNull('km')->where('km','!=','0');
        $datas = $result->get(); 

        $htmlContent = "<!DOCTYPE html>
        <html>
        <head> 
            <!-- Include Bootstrap CSS -->
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
            <link rel='stylesheet' href='https://unpkg.com/leaflet/dist/leaflet.css' />
            <script src='https://unpkg.com/leaflet/dist/leaflet.js'></script>

        </head>
        </head>
        <body>
            <div class='container-'>
                <h1 class='text-center'>etc ba LKS</h1>";

                foreach($datas as $data){
                $htmlContent.="


        
                <table class='table table-bordered'>
                    <thead>
                        <th>ID</th>
                        <th>WP NAME</th>
                        <th>VISIT DATE</th>
                        <th>TIME</th>
                        <th>READING START</th>
                        <th>READING END</th>
                        <th>CYCLE</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$data->id</td>
                            <td>$data->wp_name</td>
                            <td> ". date('Y-m-d', strtotime($data->visit_date)) ."</td>
                            <td> ". date('H:i:s', strtotime($data->time)) ."</td>
                            <td>$data->reading_start</td>
                            <td>$data->reading_end </td>
                            <td>$data->cycle</td>
                        </tr>
                    </tbody>
                </table>

                <div class='container p-5 ms-auto'>
                    <div id='map-$data->id' class='map' style='height: 300px;width:800px; marign :20px ;'></div>
                </div>
    
           

            <script>
            var map = L.map('map-$data->id').setView([3.016603, 101.858382], 5);
                document.getElementById('map-$data->id').style.cursor = 'pointer'
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
           
            </script>
        
                
        " ;
                }
                $htmlContent .= "
        </body>
        </html>
";        
// File::put(public_path('assets/html/testing ujsf.html'), $htmlContent);

// if (file_exists(public_path('assets/html/testing ujsf.html'))) {
    
    
//     # code...
// }
// return "sad";
         

        $pdf = app(PDF::class);
        $pdf->loadHTML(View::make('example', ['data'=>$datas]));

        return $pdf->download('document.pdf');
    }


    public function gene(Request $request){

    
        $result = Patroling::query();
        $request =  $this->filterWithOutAccpet($result , 'vist_date' , $request);
        $result->whereNotNull('km')->where('km','!=','0');
        $result = $result->first();
        return $result;


        $htmlContent = '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                        <!-- App css -->
                <link href="'.asset("assets/css/config/default/bootstrap.min.css").'" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"/>
                <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
                <script src="'.asset("map/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js") .'"></script>
                <style>
                .table-borderles,
                .table-borderles tbody,
               .table-borderles tr,
               .table-borderles td {
                    border: none !important;
                }
                .service-page {
                    page-break-before: always;
                }
                </style>
                </head>

            <body>
                <div class="content-page">
                    <div class="content">
                        <div class="row">
                            <div class="container  col-md-7">
                                <div class="card p-3 ">
                                    <h3 class="text-center">Purchase Order</h3>
                                    <div class="col-6 p-3">
                                    </div>
';

File::put(public_path('assets/PurhaseOrderPDF/html/tesing.html'), $htmlContent);

    }
}
