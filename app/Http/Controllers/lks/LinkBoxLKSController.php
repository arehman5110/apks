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

        return view('lks.generate-lks',['title'=>'link_box' , 'url'=>'link-box']);

    }


    public function generateByVisitDate(Fpdf $fpdf, Request $req)
    {
    
        $result = LinkBox::where('ba',$req->ba)->where('visit_date', $req->visit_date)->where('qa_status','Accept');

                
        $data = $result->select('id','ba', 'bushes_status','type','link_box_image_1', 'link_box_image_2',
        'vandalism_status', 'cover_status','leaning_status','rust_status','advertise_poster_status','start_date','end_date','visit_date','coordinate','image_cover','image_cover_2','total_defects',
        'image_vandalism','image_vandalism_2','image_leaning','image_leaning_2','image_rust','image_rust_2','images_bushes','images_bushes_2','images_advertise_poster','images_advertise_poster_2')->get();

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

        $sr_no= 0;

        foreach ($data as $row) {  
    
            $sr_no++;
            $fpdf->Cell(160, 6, 'SR # : '.$sr_no ,0);

            // add substation image 1 and substation image 2
            $fpdf->Cell(40, 6, 'LINK BOX Gambar 1' ,0);
            $fpdf->Cell(40, 6, 'LINK BOX Gambar 2' ,0);
            $fpdf->Ln();

     
            $fpdf->Cell(160, 6, 'ID : LB-'.$row->id );

           
            if ($row->link_box_image_1 != '' && file_exists(public_path($row->link_box_image_1))) 
            {
                $fpdf->Image(public_path($row->link_box_image_1), $fpdf->GetX(), $fpdf->GetY(), 20, 20);
            } 
            $fpdf->Cell(45,6);


            if ($row->link_box_image_2 != '' && file_exists(public_path($row->link_box_image_2))) 
            {
                $fpdf->Image(public_path($row->link_box_image_2), $fpdf->GetX(), $fpdf->GetY(), 20, 20);
            } 
            $fpdf->Ln();
           
            $fpdf->Cell(165, 6, 'Tarikh Lawatan : '.$row->visit_date);     //VISIT  DATE
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'Jenis : '.$row->type);                      //Type
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TO - FROM : '.$row->end_date .' - ' .  $row->start_date);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'Koordinat : '.$row->coordinate);        //COORDINATE
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'Bil Janggal : ' .$row->total_defects);  //TOTAL DEFECTS
            $fpdf->Ln();
    
           
    
            $fpdf->SetFont('Arial', 'B', 8);
            $fpdf->SetFillColor(169, 169, 169);
    
            
            $fpdf->Cell(46, 7, 'Sampul Tidak Ditutup', 1,0,'L',true); // cover is not closed
            $fpdf->Cell(46, 7, 'Vandalism', 1, 0, 'L', true); //Vandalism
            $fpdf->Cell(46, 7, 'Condong', 1, 0, 'L', true);   //Leaning
            $fpdf->Cell(46, 7, 'Berkarat', 1, 0, 'L', true);  //Rusty
            $fpdf->Cell(46, 7, 'Bersemak ', 1,0,'L',true);    //Bushes
            $fpdf->Cell(46, 7, 'Iklan Haram/Banner', 1,0,'L',true);  // Illeagal Ads/Banners 

            $fpdf->SetFillColor(255, 255, 255);
            $fpdf->Ln(); 

            $fpdf->Cell(46, 7, $row->cover_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(46, 7, $row->vandalism_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(46, 7, $row->leaning_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(46, 7, $row->rust_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(46, 7, $row->bushes_status=='Yes' ?'Ya' : 'Tidak', 1);
            $fpdf->Cell(46, 7, $row->advertise_poster_status=='Ya' ?'Yes' : 'Tidak', 1);


    
    
            $fpdf->Ln();

            if ($row->image_cover != '' && file_exists(public_path($row->image_cover))) 
            {  
                $fpdf->Image(public_path($row->image_cover), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
    
            
            // $fpdf->Ln();
    
            if ($row->image_cover_2 != '' && file_exists(public_path($row->image_cover_2))) {
                 
                $fpdf->Image(public_path($row->image_cover_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }


            
            if ($row->image_vandalism != '' && file_exists(public_path($row->image_vandalism))) {
                 
                $fpdf->Image(public_path($row->image_vandalism), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
    
            
            // $fpdf->Ln();
    
            if ($row->image_vandalism_2 != '' && file_exists(public_path($row->image_vandalism_2))) {
                 
                $fpdf->Image(public_path($row->image_vandalism_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
     
           
            if ($row->image_leaning != '' && file_exists(public_path($row->image_leaning))) {
                 
                $fpdf->Image(public_path($row->image_leaning), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
    
            if ($row->image_leaning_2 !='' && file_exists(public_path($row->image_leaning_2))) {
                 
                $fpdf->Image(public_path($row->image_leaning_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
    
            
          
    
    
            if ($row->image_rust != '' && file_exists(public_path($row->image_rust))) {
                 
                $fpdf->Image(public_path($row->image_rust), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
    
            if ($row->image_rust_2 != '' && file_exists(public_path($row->image_rust_2))) {
                 
                $fpdf->Image(public_path($row->image_rust_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
            
            if ($row->images_bushes != '' && file_exists(public_path($row->images_bushes))) {
                 
                $fpdf->Image(public_path($row->images_bushes), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
    
            if ($row->images_bushes_2 != '' && file_exists(public_path($row->images_bushes_2))) {
                 
                $fpdf->Image(public_path($row->images_bushes_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
               
                $fpdf->Cell(23, 7, ''); 
            }
    

            if ($row->images_advertise_poster != '' && file_exists(public_path($row->images_advertise_poster))) {
                 
                $fpdf->Image(public_path($row->images_advertise_poster), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
                $fpdf->Cell(23, 7, ''); 
            }
    
            if ($row->images_advertise_poster_2 != '' && file_exists(public_path($row->images_advertise_poster_2))) {
                 
                $fpdf->Image(public_path($row->images_advertise_poster_2), $fpdf->GetX(), $fpdf->GetY(), 23, 30);
                $fpdf->Cell(23);
    
            }else{
               
                $fpdf->Cell(23, 7, ''); 
            }
    
    
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
     
            // Move to the next line for the next row
        }
        
        $pdfFileName = $req->ba.' - Link-Box - '.$req->visit_date.'.pdf'; 
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

            $result = LinkBox::query();
        
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
            $req['from_date'] = LinkBox::min('visit_date');
        }

        if (empty($req->to_date)) {
            $req['to_date'] = LinkBox::max('visit_date');
        }
        
        return view('lks.download-lks',['ba'=>$req->ba,'from_date'=>$req->from_date,'to_date'=>$req->to_date,'url'=>'link-box' ]); 
        
    }
}
