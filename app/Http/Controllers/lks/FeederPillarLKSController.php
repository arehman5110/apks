<?php

namespace App\Http\Controllers\lks;

use App\Http\Controllers\Controller;
use App\Models\FeederPillar;
use Illuminate\Http\Request;
use App\Traits\Filter;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\File;


class FeederPillarLKSController extends Controller
{
    use Filter;

    public function index()
    {
        return view('lks.generate-lks',['title'=>'feeder_pillar' , 'url'=>'feeder-pillar']);
 
    }

    
    public function generateByVisitDate(Fpdf $fpdf, Request $req)
    {

        $result = FeederPillar::where('ba',$req->ba)->where('visit_date', $req->visit_date)->where('qa_status','Accept');

        $data = $result->select('id','guard_status','image_advertisement_after_1', 'ba','feeder_pillar_image_1','feeder_pillar_image_2', DB::raw("CASE WHEN (gate_status->>'unlocked')::text='true' THEN 'Ya' ELSE 'Tidak' END as unlocked"), DB::raw("CASE WHEN (gate_status->>'demaged')::text='true' THEN 'Ya' ELSE 'Tidak' END as demaged"), DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN 'Ya' ELSE 'Tidak' END as other_gate"),DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN (gate_status->>'other_value')::text ELSE '' END as gate_other_value") , 'vandalism_status', 'leaning_staus', 'rust_status', 'advertise_poster_status', 'visit_date', 'size', 'coordinate', 'image_gate', 'image_gate_2', 'total_defects', 'image_vandalism', 'image_vandalism_2', 'image_leaning', 'image_leaning_2', 'image_rust', 'image_rust_2', 'images_advertise_poster', 'images_advertise_poster_2')->get();


        $pdf = PDF::loadView('feeder-pillar.lks-feeder-pillar-template',['datas'=>$data,'ba'=>$req->ba , 'visit_date'=>$req->visit_date]);
        $pdf->setPaper('A4', 'landscape');
        $pdfFileName = $req->ba.' - Feeder-pillar - '.$req->visit_date.'.pdf';    
        $folderPath = 'temp/'.$req->folder_name .'/'. $pdfFileName;
        $pdfFilePath = public_path( $folderPath); 
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
        if ($req->ajax()) 
        { 

            $result = FeederPillar::query();
        
            $result = $this->filter($result , 'visit_date',$req)->where('qa_status','Accept')->whereNotNull('visit_date');
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
    
            $pdfFileName = $req->ba.' - Feeder-pillar - Table - Of - Contents - '.$req->from_date.' - '.$req->from_date.'.pdf'; 

            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
            $userID = Auth::user()->id;
            $folderName = 'temporary-feeder-pillar-folder-'.$userID;
            $folderPath = public_path('temp/'.$folderName);

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0777, true, true);
            }

            $pdfFilePath = $folderPath.'/'. $pdfFileName;  

            $fpdf->output('F', $pdfFilePath);
            
    
     
            $response = [
                'pdfPath' => $pdfFileName,
                'visit_dates'=>$visitDates,
                'folder_name'=>$folderName

            ];
    
            return response()->json($response);
        }
        if (empty($req->from_date)) {
            $req['from_date'] = FeederPillar::min('visit_date');
        }

        if (empty($req->to_date)) {
            $req['to_date'] = FeederPillar::max('visit_date');
        }
        
        return view('lks.download-lks',['ba'=>$req->ba,'from_date'=>$req->from_date,'to_date'=>$req->to_date,'url'=>'feeder-pillar']); 
        
    }
}
