<?php

namespace App\Http\Controllers\lks;

use App\Http\Controllers\Controller;
use App\Models\LinkBox;
use App\Traits\Filter;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class LinkBoxLKSController extends Controller
{
    use Filter;

    public function index(){

        return view('link-box.lks');
    }


    public function gene(Fpdf $fpdf, Request $req){
    
        $result = LinkBox::query();
    
            $result = $this->filter($result , 'visit_date',$req)->where('qa_status','Accept');
    
                    
          $data = $result->select('id','ba', 'bushes_status','type',
           'vandalism_status', 'cover_status','leaning_status','rust_status','advertise_poster_status','start_date','end_date','visit_date','coordinate','image_cover','image_cover_2','total_defects',
           'image_vandalism','image_vandalism_2','image_leaning','image_leaning_2','image_rust','image_rust_2','images_bushes','images_bushes_2','images_advertise_poster','images_advertise_poster_2')->get();

        $fpdf->AddPage('L', 'A4');
        $fpdf->SetFont('Arial', 'B', 22);
        
        $fpdf->Cell(80, 25, $req->ba .' LKS');
        $fpdf->Ln();  
    
        $imagePath = public_path('assets/web-images/main-logo.png');  
        $fpdf->Image($imagePath, 190, 20, 57, 0);
        $fpdf->SetFont('Arial', 'B', 9);
        foreach ($data as $row) {  
    
    
    
     
            $fpdf->Cell(60, 6, 'ID : LB-'.$row->id );
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'VISIT  DATE : '.$row->visit_date);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TYPE : '.$row->type);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TO - FROM : '.$row->end_date .' - ' .  $row->start_date);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'COORDINATE : '.$row->coordinate);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TOTAL DEFECTS : ' .$row->total_defects);
            $fpdf->Ln();
    
           
    
            $fpdf->SetFont('Arial', 'B', 8);
    
            $fpdf->SetFillColor(169, 169, 169);
    
            
            $fpdf->Cell(46, 7, 'COVER IS NOT CLOSED', 1,0,'L',true);
     
            $fpdf->Cell(46, 7, 'VANDALISM ', 1,0,'L',true);
            $fpdf->Cell(46, 7, 'LEANIGN ', 1,0,'L',true);
            $fpdf->Cell(46, 7, 'RUSTY ', 1,0,'L',true);
            $fpdf->Cell(46, 7, 'BUSHES ', 1,0,'L',true); 
            $fpdf->Cell(46, 7, 'ILLLEGAL ADS/BANNERS ', 1,0,'L',true); 


            $fpdf->SetFillColor(255, 255, 255);
            $fpdf->Ln(); 
            $fpdf->Cell(46, 7, $row->cover_status, 1);

            $fpdf->Cell(46, 7, $row->vandalism_status, 1);
            $fpdf->Cell(46, 7, $row->leaning_status, 1);
            $fpdf->Cell(46, 7, $row->rust_status, 1);
            $fpdf->Cell(46, 7, $row->bushes_status, 1);
            $fpdf->Cell(46, 7, $row->advertise_poster_status, 1);


    
    
            $fpdf->Ln();

            if ($row->image_cover != '' && file_exists(public_path($row->image_cover))) {
                 
                $fpdf->Image(public_path($row->image_cover), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    
            
            // $fpdf->Ln();
    
            if ($row->image_cover_2 != '' && file_exists(public_path($row->image_cover_2))) {
                 
                $fpdf->Image(public_path($row->image_cover_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }


            
            if ($row->image_vandalism != '' && file_exists(public_path($row->image_vandalism))) {
                 
                $fpdf->Image(public_path($row->image_vandalism), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    
            
            // $fpdf->Ln();
    
            if ($row->image_vandalism_2 != '' && file_exists(public_path($row->image_vandalism_2))) {
                 
                $fpdf->Image(public_path($row->image_vandalism_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
     
           
            if ($row->image_leaning != '' && file_exists(public_path($row->image_leaning))) {
                 
                $fpdf->Image(public_path($row->image_leaning), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    
            if ($row->image_leaning_2 !='' && file_exists(public_path($row->image_leaning_2))) {
                 
                $fpdf->Image(public_path($row->image_leaning_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    
            
          
    
    
            if ($row->image_rust != '' && file_exists(public_path($row->image_rust))) {
                 
                $fpdf->Image(public_path($row->image_rust), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    
            if ($row->image_rust_2 != '' && file_exists(public_path($row->image_rust_2))) {
                 
                $fpdf->Image(public_path($row->image_rust_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
            
            if ($row->images_bushes != '' && file_exists(public_path($row->images_bushes))) {
                 
                $fpdf->Image(public_path($row->images_bushes), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    
            if ($row->images_bushes_2 != '' && file_exists(public_path($row->images_bushes_2))) {
                 
                $fpdf->Image(public_path($row->images_bushes_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
               
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    

            if ($row->images_advertise_poster != '' && file_exists(public_path($row->images_advertise_poster))) {
                 
                $fpdf->Image(public_path($row->images_advertise_poster), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    
            if ($row->images_advertise_poster_2 != '' && file_exists(public_path($row->images_advertise_poster_2))) {
                 
                $fpdf->Image(public_path($row->images_advertise_poster_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
               
                $fpdf->Cell(23, 7, 'no image found', 1); 
            }
    
    
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
     
            // Move to the next line for the next row
        }
        
        return $fpdf->output('I','link_box.pdf');
    }
}
