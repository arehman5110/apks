<?php

namespace App\Http\Controllers\lks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Substation;
use App\Traits\Filter;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use Illuminate\Support\Facades\File;


class SubstationLKSController extends Controller
{
   use Filter;

    public function index(){

        return view('lks.generate-lks',['title'=>'substation' , 'url'=>'substation']);
    }




    private function getImageUrl($path)
    {
        // Check if the image file exists and is of a supported type
        if ($path != '' && file_exists(public_path($path))) {
            return url($path);
        }

        // Return a placeholder or a default image URL if the image is not found
        return url('path/to/placeholder-image.jpg');
    }



    public function generateByVisitDate($lanf ,Fpdf $fpdf,Request $req) 
    {

       
        
        
        $result = Substation::where('ba',$req->ba)->where('visit_date', $req->visit_date)->where('qa_status','Accept');
        // $result = Substation::query();
        // $result = $this->filter($result , 'visit_date',$req)->where('qa_status','Accept');
        $data = $result->select('id','ba','updated_at', 'name', DB::raw("CASE WHEN (gate_status->>'unlocked')::text='true' THEN 'Ya' ELSE 'Tidak' END as unlocked"), DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN (gate_status->>'other_value')::text ELSE '' END as gate_other_value") ,DB::raw("CASE WHEN (building_status->>'other')::text='true' THEN (building_status->>'other_value')::text ELSE '' END as building_status_other_value") , DB::raw("CASE WHEN (gate_status->>'demaged')::text='true' THEN 'Ya' ELSE 'Tidak' END as demaged"), DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN 'Ya' ELSE 'Tidak' END as other_gate"), DB::raw("CASE WHEN (building_status->>'broken_roof')::text='true' THEN 'Ya' ELSE 'Tidak' END as broken_roof"), DB::raw("CASE WHEN (building_status->>'broken_gutter')::text='true' THEN 'Ya' ELSE 'Tidak' END as broken_gutter"), DB::raw("CASE WHEN (building_status->>'broken_base')::text='true' THEN 'Ya' ELSE 'Tidak' END as broken_base"), DB::raw("CASE WHEN (building_status->>'other')::text='true' THEN 'Ya' ELSE 'Tidak' END as building_other"), 'grass_status', 
        'tree_branches_status', 'advertise_poster_status', 'total_defects', 'visit_date', 'substation_image_1', 'substation_image_2', 'qa_status' ,'reject_remarks','image_building','image_building_2','image_advertisement_before_1','image_advertisement_before_2',
        'images_gate_after_lock' , 'images_gate_after_lock_2','image_advertisement_after_1','image_gate','image_gate_2','image_grass' , 'image_grass_2','image_tree_branches','image_tree_branches_2')->get();
    
        // return view ('substation.lks-pdf-template',['datas'=>$data , 'ba'=>$req->ba, 'visit_date'=>$req->from_date]);

        $pdf = PDF::loadView('substation.lks-substation-template',['datas'=>$data,'ba'=>$req->ba , 'visit_date'=>$req->visit_date]);
        $pdf->setPaper('A4', 'landscape');
        $pdfFileName = $req->ba.' - Pencawang - '.$req->visit_date.'.pdf'; 
        $pdfFilePath = public_path('temp/' . $pdfFileName); 
        if (file_exists($pdfFilePath)) {
            File::delete($pdfFilePath);
        }            
        $pdf->save($pdfFilePath);

        $response = [
            'pdfPath' => $pdfFileName,
        ];

        return response()->json($response);
        
    }



    public function gene(Fpdf $fpdf, Request $req)
    {
        // return "Sdfsd";
        if ($req->ajax()) 
        { 

            $result = Substation::query();

           
        
            $result = $this->filter($result , 'visit_date',$req)->where('qa_status','Accept');
            $getResultByVisitDate= $result->select('visit_date',DB::raw("count(*)"))->groupBy('visit_date')->get();  //get total count against visit_date
             
            
            $fpdf->AddPage('L', 'A4');
            $fpdf->SetFont('Arial', 'B', 22);
                //add Heading
            $fpdf->Cell(180, 25, $req->ba .' LKS ( '. ($req->from_date?? ' All ') . ' - ' . ($req->to_date?? ' All ').' )');
            $fpdf->Ln();   
            $fpdf->SetFont('Arial', 'B', 16);
                // visit date table start
            $fpdf->Cell(100,7,'JUMLAH YANG DICATAT BERHADAPAN TARIKH LAWATAN',0,1);
    
            $fpdf->SetFillColor(169, 169, 169);
            $totalRecords = 0;
    
            $visitDates = [];
            foreach ($getResultByVisitDate as $visit_date) 
            {
                $fpdf->SetFont('Arial', 'B', 9);
                $fpdf->Cell(50,7,$visit_date->visit_date,1,0,'C',true);
                $fpdf->Cell(50,7,$visit_date->count,1,0,'C');
                $fpdf->Ln();
                $totalRecords += $visit_date->count;
                $visitDates[]=$visit_date->visit_date;
                
    
            }
            $fpdf->Cell(50,7,'JUMLAH REKOD',1,0,'C',true);
            $fpdf->Cell(50,7,$totalRecords,1,0,'C');
            // visit date table end
            $fpdf->Ln();
            $fpdf->Ln();
    
            $pdfFileName = $req->ba.' - Pencawang - Table - Of - Contents - '.$req->from_date.' - '.$req->from_date.'.pdf'; 

            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
            $pdfFilePath = public_path('temp/' . $pdfFileName);  
            $fpdf->output('F', $pdfFilePath);
            
    
     
            $response = [
                'pdfPath' => $pdfFileName,
                'visit_dates'=>$visitDates,
            ];
    
            return response()->json($response);
        }
        if (empty($req->from_date)) {
            $req['from_date'] = Substation::min('visit_date');
        }

        if (empty($req->to_date)) {
            $req['to_date'] = Substation::max('visit_date');
        }
        
        return view('lks.download-lks',['ba'=>$req->ba,'from_date'=>$req->from_date,'to_date'=>$req->to_date,'url'=>'substation' ]); 
        
    }


    
}
