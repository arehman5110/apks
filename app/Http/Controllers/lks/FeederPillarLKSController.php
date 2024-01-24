<?php

namespace App\Http\Controllers\lks;

use App\Http\Controllers\Controller;
use App\Models\FeederPillar;
use Illuminate\Http\Request;
use App\Traits\Filter;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class FeederPillarLKSController extends Controller
{
    use Filter;

    public function index()
    {
        return view('feeder-pillar.lks');
    }

    public function gene(Fpdf $fpdf, Request $req)
    {
        $result = FeederPillar::query();

        $result = $this->filter($result, 'visit_date', $req)->where('qa_status', 'Accept');
        $getResultByVisitDate = clone $result;   // clone filtered query
        $getResultByVisitDate= $getResultByVisitDate->select('visit_date',DB::raw("count(*)"))->groupBy('visit_date')->get();  //get total count against visit_date
          

        $data = $result->select('id', 'ba','feeder_pillar_image_1','feeder_pillar_image_2', DB::raw("CASE WHEN (gate_status->>'unlocked')::text='true' THEN 'Yes' ELSE 'No' END as unlocked"), DB::raw("CASE WHEN (gate_status->>'demaged')::text='true' THEN 'Yes' ELSE 'No' END as demaged"), DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN 'Yes' ELSE 'No' END as other_gate"), 'vandalism_status', 'leaning_staus', 'rust_status', 'advertise_poster_status', 'visit_date', 'size', 'coordinate', 'image_gate', 'image_gate_2', 'total_defects', 'image_vandalism', 'image_vandalism_2', 'image_leaning', 'image_leaning_2', 'image_rust', 'image_rust_2', 'images_advertise_poster', 'images_advertise_poster_2')->get();

        $fpdf->AddPage('L', 'A4');
        $fpdf->SetFont('Arial', 'B', 22);


        $fpdf->Cell(180, 25, $req->ba .' LKS ( '. ($req->from_date?? ' All ') . ' - ' . ($req->to_date?? ' All ').' )');
        $fpdf->Ln();   
        $fpdf->SetFont('Arial', 'B', 16);

        $fpdf->Cell(100,7,'TOTAL RECORED AGAINST VISIT DATE',0,1);

        $fpdf->SetFillColor(169, 169, 169);
        $totalRecords = 0;

        foreach ($getResultByVisitDate as $visit_date) 
        {
            $fpdf->SetFont('Arial', 'B', 9);
            $fpdf->Cell(50,7,$visit_date->visit_date,1,0,'C',true);
            $fpdf->Cell(50,7,$visit_date->count,1,0,'C');
            $fpdf->Ln();
            $totalRecords += $visit_date->count;

        }
        $fpdf->Cell(50,7,'TOTAL RECORD',1,0,'C',true);
        $fpdf->Cell(50,7,$totalRecords,1,0,'C');

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
            $fpdf->Cell(45, 6, 'FEEDER PILLAR IMAGE 1' ,0);
            $fpdf->Cell(40, 6, 'FEEDER PILLAR IMAGE 2' ,0);
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
            $fpdf->Cell(60, 6, 'VISIT  DATE : ' . $row->visit_date);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'SIZE : ' . $row->size);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'COORDINATE : ' . $row->coordinate);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TOTAL DEFECTS : ' . $row->total_defects);
            $fpdf->Ln();

            $fpdf->SetFont('Arial', 'B', 8);

            $fpdf->SetFillColor(169, 169, 169);

            $fpdf->Cell(58, 7, 'GATE', 1, 0, 'C', true);
            $fpdf->Cell(216, 7, 'OTHERS STATUS', 1, 0, 'C', true);

            $fpdf->Ln();

            $fpdf->Cell(20, 7, 'UNLOCKED', 1, 0, 'L', true);
            $fpdf->Cell(19, 7, 'DAMAGED', 1, 0, 'L', true);
            $fpdf->Cell(19, 7, 'OTHER', 1, 0, 'L', true);

            $fpdf->Cell(54, 7, 'VANDALISM', 1, 0, 'L', true);
            $fpdf->Cell(54, 7, 'LEANING', 1, 0, 'L', true);
            $fpdf->Cell(54, 7, 'RUST', 1, 0, 'L', true);
            $fpdf->Cell(54, 7, 'ADVERTISE POSTER', 1, 0, 'L', true);
            $fpdf->SetFillColor(255, 255, 255);
            $fpdf->Ln();
            $fpdf->Cell(20, 7, $row->unlocked, 1);
            $fpdf->Cell(19, 7, $row->demaged, 1);
            $fpdf->Cell(19, 7, $row->other_gate, 1);
            $fpdf->Cell(54, 7, $row->vandalism_status, 1);

            $fpdf->Cell(54, 7, $row->leaning_staus, 1);

            $fpdf->Cell(54, 7, $row->rust_status, 1);
            $fpdf->Cell(54, 7, $row->advertise_poster_status, 1);

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

        $pdfFileName = 'FEEDER PILLAR ' . $req->ba . ' LKS ( ' . ($req->from_date ?? 'All') . ' - ' . ($req->to_date ?? 'All') . ' ).pdf';
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
        return  $fpdf->output('D', $pdfFileName );
    }
}
