<?php

namespace App\Http\Controllers\lks;

use App\Http\Controllers\Controller;
use App\Models\CableBridge;
use App\Traits\Filter;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class CableBridgeLKSController extends Controller
{
    use Filter;

    public function index()
    {
        return view('lks.generate-lks',['title'=>'link_box' , 'url'=>'cable-bridge']);

    }

    public function generateByVisitDate(Fpdf $fpdf, Request $req)
    {
        $result = CableBridge::query();

        $result = $this->filter($result, 'visit_date', $req)->where('qa_status', 'Accept');

        $data = $result->select('id', 'ba','cable_bridge_image_1','cable_bridge_image_2','bushes_status', 'vandalism_status', 'pipe_staus', 'collapsed_status', 'rust_status', 'start_date', 'end_date', 'visit_date', 'voltage', 'coordinate', 'image_pipe', 'image_pipe_2', 'total_defects', 'image_vandalism', 'image_vandalism_2', 'image_collapsed', 'image_collapsed_2', 'image_rust', 'image_rust_2', 'images_bushes', 'images_bushes_2')->get();
      

        $fpdf->AddPage('L', 'A4');
        $fpdf->SetFont('Arial', 'B', 22);

        $fpdf->Cell(180, 25, $req->ba .' ' .$req->visit_date );
        $fpdf->Ln();  

        $fpdf->SetFont('Arial', 'B', 14);

        $fpdf->Cell(50,7,'Jumlah Rekod',1);
        $fpdf->Cell(20,7,sizeof($data),1);

        $fpdf->Ln();
        $fpdf->Ln();

        $imagePath = public_path('assets/web-images/main-logo.png');
        $fpdf->Image($imagePath, 190, 20, 57, 0);
        $fpdf->SetFont('Arial', 'B', 9);

        $sr_no = 0;
        foreach ($data as $row) {
            $sr_no++;
            $fpdf->Cell(160, 6, 'SR # : '.$sr_no ,0);

            // add substation image 1 and substation image 2
            $fpdf->Cell(40, 6, 'CABLE BRIDGE IMAGE 1' ,0);
            $fpdf->Cell(40, 6, 'CABLE BRIDGE IMAGE 2' ,0);
            $fpdf->Ln();

            $fpdf->Cell(165, 6, 'ID : CB-' . $row->id); 
            if ($row->cable_bridge_image_1 != '' && file_exists(public_path($row->cable_bridge_image_1))) 
            {
                $fpdf->Image(public_path($row->cable_bridge_image_1), $fpdf->GetX(), $fpdf->GetY(), 20, 20);
            } 
            $fpdf->Cell(45,6);
            // $fpdf->Ln();


            if ($row->cable_bridge_image_2 != '' && file_exists(public_path($row->cable_bridge_image_2))) 
            {
                $fpdf->Image(public_path($row->cable_bridge_image_2), $fpdf->GetX(), $fpdf->GetY(), 20, 20);
            } 
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'VISIT  DATE : ' . $row->visit_date);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'VOLTAGE : ' . $row->voltage);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TO - FROM : ' . $row->end_date . ' - ' . $row->start_date);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'COORDINATE : ' . $row->coordinate);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TOTAL DEFECTS : ' . $row->total_defects);
            $fpdf->Ln();

            $fpdf->SetFont('Arial', 'B', 8);

            $fpdf->SetFillColor(169, 169, 169);

            $fpdf->Cell(54, 7, 'VANDALISM', 1, 0, 'L', true);
            $fpdf->Cell(54, 7, 'Runtuh Status', 1, 0, 'L', true); // colapsed
            $fpdf->Cell(54, 7, 'Berkarat', 1, 0, 'L', true); // Rsuty
            $fpdf->Cell(54, 7, 'Bersemak Status', 1, 0, 'L', true); //BUSHES STATUS
            $fpdf->Cell(54, 7, 'Paip Status', 1, 0, 'L', true);  //PIPE STATUS

            $fpdf->SetFillColor(255, 255, 255);
            $fpdf->Ln();

            $fpdf->Cell(54, 7, $row->vandalism_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(54, 7, $row->collapsed_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(54, 7, $row->rust_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(54, 7, $row->bushes_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(54, 7, $row->pipe_staus=='Yes' ?'Ya' : 'Tidak', 1);

            $fpdf->Ln();

            if ($row->image_vandalism != '' && file_exists(public_path($row->image_vandalism))) {
                $fpdf->Image(public_path($row->image_vandalism), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            // $fpdf->Ln();

            if ($row->image_vandalism_2 != '' && file_exists(public_path($row->image_vandalism_2))) {
                $fpdf->Image(public_path($row->image_vandalism_2), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_collapsed != '' && file_exists(public_path($row->image_collapsed))) {
                $fpdf->Image(public_path($row->image_collapsed), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_collapsed_2 != '' && file_exists(public_path($row->image_collapsed_2))) {
                $fpdf->Image(public_path($row->image_collapsed_2), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
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

            if ($row->images_bushes != '' && file_exists(public_path($row->images_bushes))) {
                $fpdf->Image(public_path($row->images_bushes), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->images_bushes_2 != '' && file_exists(public_path($row->images_bushes_2))) {
                $fpdf->Image(public_path($row->images_bushes_2), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_pipe != '' && file_exists(public_path($row->image_pipe))) {
                $fpdf->Image(public_path($row->image_pipe), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
                $fpdf->Cell(27);
            } else {
                $fpdf->Cell(27, 7, '');
            }

            if ($row->image_pipe_2 != '' && file_exists(public_path($row->image_pipe_2))) {
                $fpdf->Image(public_path($row->image_pipe_2), $fpdf->GetX(), $fpdf->GetY(), 27, 30);
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

        $pdfFileName = $req->ba.' - Cable-Bridge - '.$req->visit_date.'.pdf'; 
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
        $pdfFilePath = public_path('temp/' . $pdfFileName);  
        $fpdf->output('F', $pdfFilePath);
 

        return response()->json(['pdfPath'=>'pdfPath']);
    }

    public function gene(Fpdf $fpdf, Request $req)
    {
        if ($req->ajax()) 
        { 

            $result = CableBridge::query();
        
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
        
        return view('lks.download-lks',['ba'=>$req->ba,'from_date'=>$req->from_date,'to_date'=>$req->to_date,'url'=>'cable-bridge']); 
        
    }

}
