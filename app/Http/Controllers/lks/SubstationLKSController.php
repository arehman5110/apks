<?php

namespace App\Http\Controllers\lks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Substation;
use App\Traits\Filter;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class SubstationLKSController extends Controller
{
   use Filter;

    public function index(){

        return view('substation.lks');
    }

    public function getDataForLKS(Request $req){

        $result = Substation::query();

        $result = $this->filter($result , 'visit_date',$req)->where('qa_status','Accept');


        return $result->get();
}


public function gene(Fpdf $fpdf, Request $req){
    
    $result = Substation::query();

        $result = $this->filter($result , 'visit_date',$req)->where('qa_status','Accept');


                
      $data = $result->select('id','ba','updated_at', 'name', DB::raw("CASE WHEN (gate_status->>'unlocked')::text='true' THEN 'Yes' ELSE 'No' END as unlocked"), DB::raw("CASE WHEN (gate_status->>'demaged')::text='true' THEN 'Yes' ELSE 'No' END as demaged"), DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN 'Yes' ELSE 'No' END as other_gate"), DB::raw("CASE WHEN (building_status->>'broken_roof')::text='true' THEN 'Yes' ELSE 'No' END as broken_roof"), DB::raw("CASE WHEN (building_status->>'broken_gutter')::text='true' THEN 'Yes' ELSE 'No' END as broken_gutter"), DB::raw("CASE WHEN (building_status->>'broken_base')::text='true' THEN 'Yes' ELSE 'No' END as broken_base"), DB::raw("CASE WHEN (building_status->>'other')::text='true' THEN 'Yes' ELSE 'No' END as building_other"), 'grass_status', 
      'tree_branches_status', 'advertise_poster_status', 'total_defects', 'visit_date', 'substation_image_1', 'substation_image_2', 'qa_status' ,'reject_remarks','image_building','image_building_2','image_advertisement_before_1','image_advertisement_before_2',
      'images_gate_after_lock' , 'images_gate_after_lock_2','image_gate','image_gate_2','image_grass' , 'image_grass_2','image_tree_branches','image_tree_branches_2')->get();
    // $fpdf->AddPage();
    $fpdf->AddPage('L', 'A4');
    $fpdf->SetFont('Arial', 'B', 22);
    
    $fpdf->Cell(80, 25, $req->ba .' LKS');
    $fpdf->Ln();  

    $imagePath = public_path('assets/web-images/main-logo.png');  
    $fpdf->Image($imagePath, 120, 10, 27, 0);
    $fpdf->SetFont('Arial', 'B', 9);
    foreach ($data as $row) {  



 
        $fpdf->Cell(60, 6, 'NAME : '.$row->name);
        $fpdf->Ln();
        $fpdf->Cell(60, 6, 'VISIT  DATE : '.$row->visit_date);
        $fpdf->Ln();
        $fpdf->Cell(60, 6, 'TOTAL DEFECTS : ' .$row->total_defects);
        $fpdf->Ln();

       

        $fpdf->SetFont('Arial', 'B', 8);

        $fpdf->SetFillColor(169, 169, 169);

        $fpdf->Cell(58,7,'GATE',1,0,'C',true);
        $fpdf->Cell(50,7,'TREE',1,0,'C',true);
        $fpdf->Cell(72,7,'BUILDING BROKEN',1,0,'C',true);
        $fpdf->Cell(50,7,'POSTER',1,0,'C',true);
        $fpdf->Cell(50,7,'GRASS',1,0,'C',true);




        $fpdf->Ln();

        $fpdf->Cell(20, 7, 'UNLOCKED', 1,0,'L',true);
        $fpdf->Cell(19, 7, 'DAMAGED', 1,0,'L',true);
        $fpdf->Cell(19, 7, 'OTHER', 1,0,'L',true);
        $fpdf->Cell(50, 7, 'BRANCHES IN P.E', 1,0,'L',true);
        $fpdf->Cell(18, 7, 'ROOF', 1,0,'L',true);
        $fpdf->Cell(18, 7, 'GUTTER', 1,0,'L',true);
        $fpdf->Cell(18, 7, 'BASE', 1,0,'L',true);
        $fpdf->Cell(18, 7, 'OTHER', 1,0,'L',true);
        $fpdf->Cell(50, 7, 'Advertisement', 1,0,'L',true);
        $fpdf->Cell(50, 7, 'LONG GRASS', 1,0,'L',true);

        $fpdf->SetFillColor(255, 255, 255);
        $fpdf->Ln();
        $fpdf->Cell(20, 7, $row->unlocked, 1);
        $fpdf->Cell(19, 7, $row->demaged, 1);
        $fpdf->Cell(19, 7, $row->other_gate, 1);
        $fpdf->Cell(50, 7, $row->tree_branches_status, 1);
 
  
        $fpdf->Cell(18, 7, $row->broken_roof, 1);

        $fpdf->Cell(18, 7, $row->broken_gutter, 1);
        $fpdf->Cell(18, 7, $row->broken_base, 1);
        $fpdf->Cell(18, 7, $row->building_other, 1);
        $fpdf->Cell(50, 7, $row->advertise_poster_status, 1);
        $fpdf->Cell(50, 7, $row->grass_status, 1);


        $fpdf->Ln();
        
        if ($row->image_gate != '' && file_exists(public_path($row->image_gate))) {
             
            $fpdf->Image(public_path($row->image_gate), $fpdf->GetX(), $fpdf->GetY(), 29, 30);
            $fpdf->Cell(29);

        }else{
            $fpdf->Cell(29, 7, 'no image found', 1); 
        }

        
        // $fpdf->Ln();

        if ($row->image_gate_2 != '' && file_exists(public_path($row->image_gate_2))) {
             
            $fpdf->Image(public_path($row->image_gate_2), $fpdf->GetX(), $fpdf->GetY(), 29, 30);
            $fpdf->Cell(29);

        }else{
            $fpdf->Cell(29, 7, 'no image found', 1); 
        }
 
       
        if ($row->image_tree_branches != '' && file_exists(public_path($row->image_tree_branches))) {
             
            $fpdf->Image(public_path($row->image_tree_branches), $fpdf->GetX(), $fpdf->GetY(), 25, 30);
            $fpdf->Cell(25);

        }else{
            $fpdf->Cell(25, 7, 'no image found', 1); 
        }

        if ($row->image_tree_branches_2 !='' && file_exists(public_path($row->image_tree_branches_2))) {
             
            $fpdf->Image(public_path($row->image_tree_branches_2), $fpdf->GetX(), $fpdf->GetY(), 25, 30);
            $fpdf->Cell(25);

        }else{
            $fpdf->Cell(25, 7, 'no image found', 1); 
        }

        if ($row->image_building !='' && file_exists(public_path($row->image_building))) {
             
            $fpdf->Image(public_path($row->image_building), $fpdf->GetX(), $fpdf->GetY(), 36, 30);
            $fpdf->Cell(36);

        }else{
            $fpdf->Cell(36, 7, 'no image found', 1); 
        }

        if ($row->image_building_2 != '' && file_exists(public_path($row->image_building_2))) {
             
            $fpdf->Image(public_path($row->image_building_2), $fpdf->GetX(), $fpdf->GetY(), 36, 30);
            $fpdf->Cell(36);

        }else{
            $fpdf->Cell(36, 7, 'no image found', 1); 
        }

      


        if ($row->image_advertisement_before_1 != '' && file_exists(public_path($row->image_advertisement_before_1))) {
             
            $fpdf->Image(public_path($row->image_advertisement_before_1), $fpdf->GetX(), $fpdf->GetY(), 25, 30);
            $fpdf->Cell(25);

        }else{
            $fpdf->Cell(25, 7, 'no image found', 1); 
        }

        if ($row->image_advertisement_before_2 != '' && file_exists(public_path($row->image_advertisement_before_2))) {
             
            $fpdf->Image(public_path($row->image_advertisement_before_2), $fpdf->GetX(), $fpdf->GetY(), 25, 30);
            $fpdf->Cell(25);

        }else{
            $fpdf->Cell(25, 7, 'no image found', 1); 
        }
        
        if ($row->image_grass != '' && file_exists(public_path($row->image_grass))) {
             
            $fpdf->Image(public_path($row->image_grass), $fpdf->GetX(), $fpdf->GetY(), 25, 30);
            $fpdf->Cell(25);

        }else{
            $fpdf->Cell(25, 7, 'no image found', 1); 
        }

        if ($row->image_grass_2 != '' && file_exists(public_path($row->image_grass_2))) {
             
            $fpdf->Image(public_path($row->image_grass_2), $fpdf->GetX(), $fpdf->GetY(), 25, 30);
            $fpdf->Cell(25);

        }else{
           
            $fpdf->Cell(25, 7, 'no image found', 1); 
        }


        $fpdf->Ln();$fpdf->Ln();$fpdf->Ln();
        $fpdf->Ln();
        $fpdf->Ln();
 
        // Move to the next line for the next row
    }
    
    return $fpdf->output('I','substation.pdf');
}
}
