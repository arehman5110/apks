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

        $data = $result->select('id','guard_status','image_advertisement_after_1', 'ba','feeder_pillar_image_1','feeder_pillar_image_2', DB::raw("CASE WHEN (gate_status->>'unlocked')::text='true' THEN 'Ya' ELSE 'Tidak' END as unlocked"), DB::raw("CASE WHEN (gate_status->>'demaged')::text='true' THEN 'Ya' ELSE 'Tidak' END as demaged"), DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN 'Ya' ELSE 'Tidak' END as other_gate"), 'vandalism_status', 'leaning_staus', 'rust_status', 'advertise_poster_status', 'visit_date', 'size', 'coordinate', 'image_gate', 'image_gate_2', 'total_defects', 'image_vandalism', 'image_vandalism_2', 'image_leaning', 'image_leaning_2', 'image_rust', 'image_rust_2', 'images_advertise_poster', 'images_advertise_poster_2')->get();


        $pdf = PDF::loadView('feeder-pillar.lks-feeder-pillar-template',['datas'=>$data,'ba'=>$req->ba , 'visit_date'=>$req->visit_date]);
        $pdf->setPaper('A4', 'landscape');
        $pdfFileName = $req->ba.' - Feeder-pillar - '.$req->visit_date.'.pdf'; 
        $pdfFilePath = public_path('temp/' . $pdfFileName);     
        if (file_exists($pdfFilePath)) {
            File::delete($pdfFilePath);
        }    
        $pdf->save($pdfFilePath);

        $response = [
            'pdfPath' => $pdfFileName,
        ];

        return response()->json($response);


        //  Need to reomve





        $fpdf->AddPage('L', 'A4');
        $fpdf->SetFont('Arial', 'B', 22);

 
        $fpdf->Cell(180, 25, $req->ba .' ' .$req->visit_date );
        $fpdf->Ln();  

        $fpdf->SetFont('Arial', 'B', 16);

        $fpdf->Cell(50,7,'Jumlah Rekod',1);
        $fpdf->Cell(20,7,sizeof($data),1);

        $fpdf->Ln();
        $fpdf->Ln();

        $imagePath = public_path('assets/web-images/main-logo.png');
        $fpdf->Image($imagePath, 190, 20, 57, 0);
        $fpdf->SetFont('Arial', 'B', 9);
        $sr_no= 0;

        foreach ($data as $row) {
            $sr_no++;
            $fpdf->Cell(160, 6, 'SR # : '.$sr_no ,0);

            // add feeder pilar images  Header 
            $fpdf->Cell(45, 6, 'FEEDER PILLAR Gambar 1' ,0);
            $fpdf->Cell(40, 6, 'FEEDER PILLAR Gambar 2' ,0);
            $fpdf->Ln();

            $fpdf->Cell(165, 6, 'ID : FP-' . $row->id);
 
            // add feeder pillar images
            if ($row->feeder_pillar_image_1 != '' && file_exists(public_path($row->feeder_pillar_image_1))) 
            {

                $fpdf->Image(public_path($row->feeder_pillar_image_1), $fpdf->GetX(), $fpdf->GetY(), 20, 20);
            } 
            $fpdf->Cell(45,6);
            // $fpdf->Ln();


            if ($row->feeder_pillar_image_2 != '' && file_exists(public_path($row->feeder_pillar_image_2))) 
            {
                $fpdf->Image(public_path($row->feeder_pillar_image_2), $fpdf->GetX(), $fpdf->GetY(), 20, 20);
            }
            $fpdf->Ln(); 
            $fpdf->Cell(60, 6, 'Tarikh Lawatan : ' . $row->visit_date);     //VISIT  DATE
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'Saiz : ' . $row->size);                     //SIZE
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'Koordinat : ' . $row->coordinate);          //COORDINATE
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'Bil Janggal : ' . $row->total_defects);     //TOTAL DEFECTS
            $fpdf->Ln();

            $fpdf->SetFont('Arial', 'B', 8);

            $fpdf->SetFillColor(169, 169, 169);

            $fpdf->Cell(58, 7, 'Pintu Pagar', 1, 0, 'C', true);  //GATE
            $fpdf->Cell(216, 7, 'STATUS LAIN', 1, 0, 'C', true);  // OTHERS STATUS

            $fpdf->Ln();

            $fpdf->Cell(20, 7, 'DIBUKA', 1,0,'L',true);   //unlocked
            $fpdf->Cell(19, 7, 'Rosak', 1,0,'L',true);    //damaged
            $fpdf->Cell(19, 7, 'Lain', 1,0,'L',true);      //other

            $fpdf->Cell(54, 7, 'Vandalism', 1, 0, 'L', true); //Vandalism
            $fpdf->Cell(54, 7, 'Condong', 1, 0, 'L', true);   //Leaning
            $fpdf->Cell(54, 7, 'Berkarat', 1, 0, 'L', true);  //Rusty
            $fpdf->Cell(54, 7, 'Iklan Poster', 1, 0, 'L', true); //ADVERTISE POSTER
            $fpdf->SetFillColor(255, 255, 255);
            $fpdf->Ln();
            $fpdf->Cell(20, 7, $row->unlocked, 1);
            $fpdf->Cell(19, 7, $row->demaged, 1);
            $fpdf->Cell(19, 7, $row->other_gate, 1);
            $fpdf->Cell(54, 7, $row->vandalism_status=='Yes' ?'Ya' : 'Tidak', 1);

            $fpdf->Cell(54, 7, $row->leaning_staus=='Yes' ?'Ya' : 'Tidak', 1);

            $fpdf->Cell(54, 7, $row->rust_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(54, 7, $row->advertise_poster_status=='Yes' ?'Ya' : 'Tidak', 1);

            $fpdf->Ln();

            if ($row->image_gate != '' && file_exists(public_path($row->image_gate))) {
                $fpdf->Image(public_path($row->image_gate), $fpdf->GetX(), $fpdf->GetY(), 29, 30);
                $fpdf->Cell(29);
            } else {
                $fpdf->Cell(29, 7, '');
            }

            // $fpdf->Ln();

            if ($row->image_gate_2 != '' && file_exists(public_path($row->image_gate_2))) {
                $fpdf->Image(public_path($row->image_gate_2), $fpdf->GetX(), $fpdf->GetY(), 29, 30);
                $fpdf->Cell(29);
            } else {
                $fpdf->Cell(29, 7, '');
            }

            if ($row->image_vandalism != '' && file_exists(public_path($row->image_vandalism))) {
                $fpdf->Image(public_path($row->image_vandalism), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_vandalism_2 != '' && file_exists(public_path($row->image_vandalism_2))) {
                $fpdf->Image(public_path($row->image_vandalism_2), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_leaning != '' && file_exists(public_path($row->image_leaning))) {
                $fpdf->Image(public_path($row->image_leaning), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_leaning_2 != '' && file_exists(public_path($row->image_leaning_2))) {
                $fpdf->Image(public_path($row->image_leaning_2), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_rust != '' && file_exists(public_path($row->image_rust))) {
                $fpdf->Image(public_path($row->image_rust), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_rust_2 != '' && file_exists(public_path($row->image_rust_2))) {
                $fpdf->Image(public_path($row->image_rust_2), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->images_advertise_poster != '' && file_exists(public_path($row->images_advertise_poster))) {
                $fpdf->Image(public_path($row->images_advertise_poster), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->images_advertise_poster_2 != '' && file_exists(public_path($row->images_advertise_poster_2))) {
                $fpdf->Image(public_path($row->images_advertise_poster_2), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();

            // Move to the next line for the next row
        }

        $pdfFileName = $req->ba.' - Feeder-pillar - '.$req->visit_date.'.pdf'; 
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
        $pdfFilePath = public_path('temp/' . $pdfFileName);  
        $fpdf->output('F', $pdfFilePath);
 
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
            $pdfFilePath = public_path('temp/' . $pdfFileName);  
            $fpdf->output('F', $pdfFilePath);
            
    
     
            $response = [
                'pdfPath' => $pdfFileName,
                'visit_dates'=>$visitDates,
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
