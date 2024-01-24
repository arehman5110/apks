<?php

namespace App\Http\Controllers\lks;

use App\Http\Controllers\Controller;
use App\Models\Tiang;
use Illuminate\Http\Request;

use App\Traits\Filter;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class TiangLKSController extends Controller
{
    //

    use Filter;

    public function index(){

        return view('Tiang.lks');
    }


    public function gene(Fpdf $fpdf, Request $req){
    

        // return Tiang::first();
        $result = Tiang::query();
    
            $result = $this->filter($result , 'review_date',$req)->where('qa_status','Accept');

            $getResultByVisitDate = clone $result;   // clone filtered query
            $getResultByVisitDate= $getResultByVisitDate->select('review_date as visit_date',DB::raw("count(*)"))->groupBy('visit_date')->get();  //get total count against visit_date
              
    
            $img_arr = [
                [
                    'defect_name'=>'tiang_defect',
                    'title'=>'Pole',
                    'defects'=>['cracked','leaning','dim','creepers','other']
                ],
                [
                    'defect_name'=>'talian_defect',
                    'title'=>'Line',
                    'defects'=>['joint','need_rentis','ground','other']
                ],
                [
                    'defect_name'=>'umbang_defect',
                    'title'=>'Umbang',
                    'defects'=>['breaking','creepers','cracked','stay_palte', 'other']
                ],
                [
                    'defect_name'=>'ipc_defect',
                    'title'=>'IPC',
                    'defects'=>['burn','other']
                ],
                [
                    'defect_name'=>'blackbox_defect',
                    'title'=>'Blackbox',
                    'defects'=>['cracked','other']
                ],
                [
                    'defect_name'=>'jumper',
                    'title'=>'Jumper',
                    'defects'=>['sleeve','burn','other']
                ],
                [
                    'defect_name'=>'kilat_defect',
                    'title'=>'Lightning',
                    'defects'=>['broken','other']
                ],
                [
                    'defect_name'=>'servis_defect',
                    'title'=>'Service',
                    'defects'=>['roof','won_piece','other']
                ],
                [
                    'defect_name'=>'bekalan_dua_defect',
                    'title'=>'Signage',
                    'defects'=>['damage','other']
                ],
                [
                    'defect_name'=>'kaki_lima_defect',
                    'title'=>'Main St.',
                    'defects'=>['date_wire','burn','other']
                ],
            ];

            $imageSingle = [
                ['name'=>'Crossing the Road' , 'key'=>'tapak_road_img' , 'arr'=>'tapak_condition_road'],
                ['name'=>'Sidewalk' , 'key'=>'tapak_no_vehicle_entry_img' , 'arr'=>'tapak_condition_side_walk'],
                ['name'=>'No vehicle entry' , 'key'=>'tapak_no_vehicle_entry_img' , 'arr'=>'tapak_condition_vehicle_entry'],

                ['name'=>'Area bend' , 'key'=>'kawasan_bend_img' , 'arr'=>'kawasan_bend'],
                ['name'=>'Aera Road' , 'key'=>'kawasan_road_img' , 'arr'=>'kawasan_road'],
                ['name'=>'No vehicle entry' , 'key'=>'kawasan_forest_img' , 'arr'=>'kawasan_forest'],
                ['name'=>'No vehicle entry' , 'key'=>'kawasan_other_img' , 'arr'=>'kawasan_other'],

            ];
                    
          $data = $result
           
           ->select('id','fp_road','fp_name','tiang_no','review_date','section_from','section_to','total_defects','talian_utama_connection','talian_utama',
           'pole_image_1','pole_image_2',
           'size_tiang','jenis_tiang','abc_span','pvc_span','bare_span',
           'jarak_kelegaan','talian_spec','arus_pada_tiang',
           'tiang_defect_image','talian_defect_image','umbang_defect_image','ipc_defect_image','blackbox_defect_image','jumper_image','kilat_defect_image',
           'servis_defect_image','pembumian_defect_image','bekalan_dua_defect_image','kaki_lima_defect_image', 'tapak_road_img','tapak_no_vehicle_entry_img',
           'tapak_no_vehicle_entry_img','kawasan_bend_img','kawasan_road_img','kawasan_forest_img','kawasan_other_img',
            DB::raw("ST_Y(geom) as Y"),
            DB::raw("ST_X(geom) as X"),
            DB::raw("CASE WHEN (tiang_defect->>'cracked')::text='true' THEN 'Yes' ELSE '' END as tiang_defect_cracked"),
            DB::raw("CASE WHEN (tiang_defect->>'leaning')::text='true' THEN 'Yes' ELSE '' END as tiang_defect_leaning"),
            DB::raw("CASE WHEN (tiang_defect->>'dim')::text='true' THEN 'Yes' ELSE '' END as tiang_defect_dim"),
            DB::raw("CASE WHEN (tiang_defect->>'creepers')::text='true' THEN 'Yes' ELSE '' END as tiang_defect_creepers"),
            DB::raw("CASE WHEN (tiang_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as tiang_defect_other"),
            DB::raw("CASE WHEN (talian_defect->>'joint')::text='true' THEN 'Yes' ELSE '' END as talian_defect_joint"),
            DB::raw("CASE WHEN (talian_defect->>'need_rentis')::text='true' THEN 'Yes' ELSE '' END as talian_defect_need_rentis"),
            DB::raw("CASE WHEN (talian_defect->>'ground')::text='true' THEN 'Yes' ELSE '' END as talian_defect_ground"),
            DB::raw("CASE WHEN (talian_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as talian_defect_other"),
            DB::raw("CASE WHEN (umbang_defect->>'breaking')::text='true' THEN 'Yes' ELSE '' END as umbang_defect_breaking"),
            DB::raw("CASE WHEN (umbang_defect->>'creepers')::text='true' THEN 'Yes' ELSE '' END as umbang_defect_creepers"),
            DB::raw("CASE WHEN (umbang_defect->>'cracked')::text='true' THEN 'Yes' ELSE '' END as umbang_defect_cracked"),
            DB::raw("CASE WHEN (umbang_defect->>'stay_palte')::text='true' THEN 'Yes' ELSE '' END as umbang_defect_stay_palte"),
            DB::raw("CASE WHEN (umbang_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as umbang_defect_other"),
            DB::raw("CASE WHEN (ipc_defect->>'burn')::text='true' THEN 'Yes' ELSE '' END as ipc_defect_burn"),
            DB::raw("CASE WHEN (ipc_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as ipc_defect_other"),
            DB::raw("CASE WHEN (blackbox_defect->>'cracked')::text='true' THEN 'Yes' ELSE '' END as blackbox_defect_cracked"),
            DB::raw("CASE WHEN (blackbox_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as blackbox_defect_other"),
            DB::raw("CASE WHEN (jumper->>'sleeve')::text='true' THEN 'Yes' ELSE '' END as jumper_sleeve"),
            DB::raw("CASE WHEN (jumper->>'burn')::text='true' THEN 'Yes' ELSE '' END as jumper_burn"),
            DB::raw("CASE WHEN (jumper->>'other')::text='true' THEN 'Yes' ELSE '' END as jumper_other"),
            DB::raw("CASE WHEN (kilat_defect->>'broken')::text='true' THEN 'Yes' ELSE '' END as kilat_defect_broken"),
            DB::raw("CASE WHEN (kilat_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as kilat_defect_other"),
            DB::raw("CASE WHEN (servis_defect->>'roof')::text='true' THEN 'Yes' ELSE '' END as servis_defect_roof"),
            DB::raw("CASE WHEN (servis_defect->>'won_piece')::text='true' THEN 'Yes' ELSE '' END as servis_defect_won_piece"),
            DB::raw("CASE WHEN (servis_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as servis_defect_other"),
            DB::raw("CASE WHEN (pembumian_defect->>'netural')::text='true' THEN 'Yes' ELSE '' END as pembumian_defect_netural"),
            DB::raw("CASE WHEN (pembumian_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as pembumian_defect_other"),
            DB::raw("CASE WHEN (bekalan_dua_defect->>'damage')::text='true' THEN 'Yes' ELSE '' END as bekalan_dua_defect_damage"),
            DB::raw("CASE WHEN (bekalan_dua_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as bekalan_dua_defect_other"),
            DB::raw("CASE WHEN (kaki_lima_defect->>'date_wire')::text='true' THEN 'Yes' ELSE '' END as kaki_lima_defect_date_wire"),
            DB::raw("CASE WHEN (kaki_lima_defect->>'burn')::text='true' THEN 'Yes' ELSE '' END as kaki_lima_defect_burn"),
            DB::raw("CASE WHEN (kaki_lima_defect->>'other')::text='true' THEN 'Yes' ELSE '' END as kaki_lima_defect_other"),
            DB::raw("CASE WHEN (tapak_condition::json->>'road')::text='true' THEN 'Yes' ELSE '' END as tapak_condition_road"),
            DB::raw("CASE WHEN (tapak_condition::json->>'side_walk')::text='true' THEN 'Yes' ELSE '' END as tapak_condition_side_walk"),
            DB::raw("CASE WHEN (tapak_condition::json->>'vehicle_entry')::text='true' THEN 'Yes' ELSE '' END as tapak_condition_vehicle_entry"),
            DB::raw("CASE WHEN (kawasan::json->>'bend')::text='true' THEN 'Yes' ELSE '' END as kawasan_bend"),
            DB::raw("CASE WHEN (kawasan::json->>'road')::text='true' THEN 'Yes' ELSE '' END as kawasan_road"),
            DB::raw("CASE WHEN (kawasan::json->>'forest')::text='true' THEN 'Yes' ELSE '' END as kawasan_forest"),
            DB::raw("CASE WHEN (kawasan::json->>'other')::text='true' THEN 'Yes' ELSE '' END as kawasan_other")
           )
            ->get();
 

        $fpdf->AddPage('L', 'A4');
        $fpdf->SetFont('Arial', 'B', 22);
            //add Heading
        $fpdf->Cell(180, 25, $req->ba .' LKS ( '. ($req->from_date?? ' All ') . ' - ' . ($req->to_date?? ' All ').' )');
        $fpdf->Ln();   
        $fpdf->SetFont('Arial', 'B', 16);
            // visit date table start
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
        // visit date table end
        $fpdf->Ln();
        $fpdf->Ln();


        $imagePath = public_path('assets/web-images/main-logo.png');  
        $fpdf->Image($imagePath, 190, 20, 57, 0);
        $fpdf->SetFont('Arial', 'B', 9);


        $sr_no =0;
        foreach ($data as $row) {  
    
            $sr_no++;
            $fpdf->Cell(160, 6, 'SR # : '.$sr_no ,0);

            // add substation image 1 and substation image 2
            $fpdf->Cell(40, 6, 'TINAG IMAGE 1' ,0);
            $fpdf->Cell(40, 6, 'TIANG IMAGE 2' ,0);
            $fpdf->Ln();
 
    
     
            $fpdf->Cell(165, 6, 'ID : SAVR-'.$row->id );
             
            if ($row->pole_image_1 != '' && file_exists(public_path($row->pole_image_1))) 
            {

                $fpdf->Image(public_path($row->pole_image_1), $fpdf->GetX(), $fpdf->GetY(), 20, 20);
            } 
            $fpdf->Cell(40,6);
            // $fpdf->Ln();


            if ($row->pole_image_2 != '' && file_exists(public_path($row->pole_image_2))) 
            {
                $fpdf->Image(public_path($row->pole_image_2), $fpdf->GetX(), $fpdf->GetY(), 20, 20);
            }
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'VISIT  DATE : '.$row->review_date);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TIANG NO : '.$row->tiang_no);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TO - FROM : '.$row->section_from .' - ' .  $row->section_to);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'COORDINATE : '.$row->X .' , '. $row->Y);
            $fpdf->Ln();
            $fpdf->Cell(60, 6, 'TOTAL DEFECTS : ' .$row->total_defects);
            $fpdf->Ln();
    
           $newArr = $row;


            // set font for table header
            $fpdf->SetFont('Arial', 'B', 8);
            $fpdf->SetFillColor(169, 169, 169);
 
            // table 0 header # 1/2 bare span table header # 1 start
 
            $fpdf->Cell(40, 6, 'Main Line (M) / Servis (S)' ,1,0,'C',true );
            $fpdf->Cell(45, 6, 'Number of Services Involves' ,1,0,'C',true );
            $fpdf->Cell(30, 6, 'Clearance Distance' ,1,0,'C',true );
            $fpdf->Cell(65, 6, 'Line clearance specifications' ,1,0,'C',true );
            $fpdf->Cell(90, 6, 'Inspection of current leakage on the pole' ,1,0,'C',true );

            // table 0 header # 1/2 bare span table header # 1 end
            $fpdf->Ln();

            $fpdf->SetFillColor(255, 255, 255);
            //table # 0 body values start

            $fpdf->Cell(40, 6, $row->talian_utama_connection ,1,0,'C',true );
            $fpdf->Cell(45, 6, $row->talian_utama ,1,0,'C',true );
            $fpdf->Cell(30, 6, $row->jarak_kelegaan ,1,0,'C',true );
            $fpdf->Cell(65, 6, $row->talian_spec ,1,0,'C',true );
            $fpdf->Cell(90, 6, $row->arus_pada_tiang ,1,0,'C',true );


            //table # 0 body values end
            
            $fpdf->Ln();
            $fpdf->Ln();



            //header # 1/2 bare span table header end
            $fpdf->Ln();


           // set font for table header 
           $fpdf->SetFillColor(169, 169, 169);

           // header # 1/1 bare span table header # 1 start

           $fpdf->Cell(40, 6, 'TIANG' ,1,0,'C',true );
           $fpdf->Cell(92, 6, 'ABC (SPAN)' ,1,0,'C',true );
           $fpdf->Cell(69, 6, 'PVC (SPAN)' ,1,0,'C',true );
           $fpdf->Cell(69, 6, 'BARE (SPAN)' ,1,0,'C',true );
           //header # 1/1 bare span table header end
           $fpdf->Ln();

           //header # 1/2 bare span table header # 1 start

           $fpdf->Cell(20, 6, 'SIZE TIANG' ,1,0,'L',true );  // size tiang header
           $fpdf->Cell(20, 6, 'JENIS TIANG' ,1,0,'L',true ); // jenis tiang header

           $fpdf->Cell(23, 6, '3 X 185' ,1,0,'L',true ); // abc span header start
           $fpdf->Cell(23, 6, '3 X 95' ,1,0,'L',true );
           $fpdf->Cell(23, 6, '3 X 16' ,1,0,'L',true );
           $fpdf->Cell(23, 6, '1 X 16' ,1,0,'L',true ); // abc span header end
                    
            // pvc span header start
           $fpdf->Cell(23, 6, '19/064' ,1,0,'L',true ); 
           $fpdf->Cell(23, 6, '7/083' ,1,0,'L',true );
           $fpdf->Cell(23, 6, '7/044' ,1,0,'L',true ); // pvc span header end
            
           // bare span header start
           $fpdf->Cell(23, 6, '7/173' ,1,0,'L',true );  
           $fpdf->Cell(23, 6, '7/122' ,1,0,'L',true );
           $fpdf->Cell(23, 6, '3/132' ,1,0,'L',true ); // bare span header end

            //header # 1/2 bare span table header # 1 end

           $fpdf->Ln();


            // table #1 body
           $fpdf->Cell(20, 6, $row->size_tiang ,1 );
           $fpdf->Cell(20, 6,$row->jenis_tiang,1);

           if ($row->abc_span != '') {
                $abc_span = json_decode($row->abc_span);
                $fpdf->Cell(23, 6, $abc_span->s3_185 ,1);
                $fpdf->Cell(23, 6, $abc_span->s3_95 ,1 );
                $fpdf->Cell(23, 6, $abc_span->s3_16 ,1 );
                $fpdf->Cell(23, 6, $abc_span->s1_16 ,1 );
           }
           
           if ($row->pvc_span != '') {
                $pvc_span = json_decode($row->pvc_span);
                $fpdf->Cell(23, 6, $pvc_span->s19_064 ,1 );
                $fpdf->Cell(23, 6, $pvc_span->s7_083 ,1 );
                $fpdf->Cell(23, 6, $pvc_span->s7_044 ,1);
           }

           if ($row->bare_span != '') {
                $bare_span = json_decode($row->bare_span);
                $fpdf->Cell(23, 6, $bare_span->s7_173 ,1);
                $fpdf->Cell(23, 6, $bare_span->s7_122 ,1);
                $fpdf->Cell(23, 6, $bare_span->s3_132 ,1);
           }

            // table #1 body end


           $fpdf->Ln();
           $fpdf->Ln();
           $fpdf->Ln();

           // table # 2 header 1/2

           $fpdf->Cell(100, 6, "Pole" ,1,0,'C',true);
           $fpdf->Cell(110, 6, "Line (Main / Service)" ,1,0,'C',true);
           $fpdf->Cell( 60, 6, "Umbang" ,1,0,'C',true);

           $fpdf->Ln();
           
           // table # 2 header 2/2

           $fpdf->Cell(20, 6, "Cracked" ,1,0,'C',true);             //POLE
           $fpdf->Cell(20, 6, "Leaning" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "No. Dim Post" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Creepers" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(20, 6, "Joint" ,1,0,'C',true);               // Line (Main / Service)
           $fpdf->Cell(20, 6, "Need Rentis" ,1,0,'C',true);
           $fpdf->Cell(50, 6, "Not Comply With Ground Clearance" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(30, 6, "Sagging/Breaking" ,1,0,'C',true);    // Umbang 1/2
           $fpdf->Cell(30, 6, "Creepers" ,1,0,'C',true);

           // table # 2 header 2/2 end


           $fpdf->Ln();
           $fpdf->SetFillColor(255, 255, 255);

           // table # 2 body values start

           
           $fpdf->Cell(20, 6, $row->tiang_defect_cracked,1,0,'C',true);         // Pole Values
           $fpdf->Cell(20, 6, $row->tiang_defect_leaning ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->tiang_defect_dim ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->tiang_defect_creepers ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->tiang_defect_other ,1,0,'C',true);

           $fpdf->Cell(20, 6, $row->talian_defect_joint ,1,0,'C',true);                           // Line (Main / Service) Values
           $fpdf->Cell(20, 6, $row->talian_defect_need_rentis ,1,0,'C',true);
           $fpdf->Cell(50, 6, $row->talian_defect_ground ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->talian_defect_other ,1,0,'C',true);

           $fpdf->Cell(30, 6, $row->umbang_defect_breaking ,1,0,'C',true);    // Umbang 1/2 Values
           $fpdf->Cell(30, 6, $row->umbang_defect_creepers ,1,0,'C',true);

           // table # 2 body values start


           $fpdf->Ln();
           $fpdf->Ln();

           $fpdf->SetFillColor(169, 169, 169);


           // tbale # 3 header 1/2 
           $fpdf->Cell(105, 6, "Umbang" ,1,0,'C',true);
           $fpdf->Cell(45, 6, "IPC" ,1,0,'C',true);
           $fpdf->Cell(45, 6, "Black Box" ,1,0,'C',true);
           $fpdf->Cell(75, 6, "Jumper" ,1,0,'C',true);

           $fpdf->Ln();

           // tbale # 3 header 2/2 

           $fpdf->Cell(40, 6, "No Stay Insulator/Damaged" ,1,0,'C',true);        // Umbagan
           $fpdf->Cell(45, 6, "Stay Plate / Base Stay Blocked" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(25, 6, "Burn Effect" ,1,0,'C',true);  //IPC
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(25, 6, "Kesan Bakar" ,1,0,'C',true);  // Black Box
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(30, 6, "No UV Sleeve" ,1,0,'C',true);  // Jumper
           $fpdf->Cell(25, 6, "Burn Effect" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           // tbale # 3 header 2/2 end 


           $fpdf->Ln();
           $fpdf->SetFillColor(255, 255, 255);

           // tbale # 3 body values start 

           $fpdf->Cell(40, 6, $row->umbang_defect_cracked ,1,0,'C',true);      // Umbagan Vlaues
           $fpdf->Cell(45, 6, $row->umbang_defect_stay_palte ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->umbang_defect_other ,1,0,'C',true);

           $fpdf->Cell(25, 6, $row->ipc_defect_burn ,1,0,'C',true);             //IPC values
           $fpdf->Cell(20, 6, $row->ipc_defect_other ,1,0,'C',true);

           $fpdf->Cell(25, 6, $row->blackbox_defect_cracked ,1,0,'C',true);   // Black Box values
           $fpdf->Cell(20, 6, $row->blackbox_defect_other ,1,0,'C',true);

           $fpdf->Cell(30, 6, $row->jumper_sleeve ,1,0,'C',true);        //Jumper values
           $fpdf->Cell(25, 6, $row->jumper_burn ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->jumper_other ,1,0,'C',true);

           // tbale # 3 body values start  

           $fpdf->Ln();
           $fpdf->Ln();

           // table # 4 header 1/2

           $fpdf->SetFillColor(169, 169, 169);

           $fpdf->Cell(40, 6, "Lightning catcher" ,1,0,'C',true);
           $fpdf->Cell(95, 6, "Service" ,1,0,'C',true);
           $fpdf->Cell(60, 6, "Grounding" ,1,0,'C',true);
           $fpdf->Cell(75, 6, "Signage - OFF Point / Two Way Supply" ,1,0,'C',true);

           $fpdf->Ln();

           // table # 4 header 2/2

           $fpdf->Cell(20, 6, "Broken" ,1,0,'C',true);   //Lightning catcher
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(45, 6, "The Service Line Is On The Roof" ,1,0,'C',true); //Service
           $fpdf->Cell(30, 6, "Won Piece Date" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(40, 6, "No Connection To Neutral" ,1,0,'C',true); //Grounding
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(55, 6, "Faded / Damaged / Missing Signage" ,1,0,'C',true);   //Signage - OFF Point / Two Way Supply
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);
           // table # 4 header 2/2 end



           $fpdf->Ln();

           // table # 4 body values start
           $fpdf->SetFillColor(255, 255, 255);

           $fpdf->Cell(20, 6, $row->kilat_defect_broken ,1,0,'C',true);   //Lightning catcher values
           $fpdf->Cell(20, 6, $row->kilat_defect_other ,1,0,'C',true);

           $fpdf->Cell(45, 6, $row->servis_defect_roof ,1,0,'C',true); //Service values
           $fpdf->Cell(30, 6, $row->servis_defect_won_piece ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->servis_defect_other ,1,0,'C',true);

           $fpdf->Cell(40, 6, $row->pembumian_defect_netural ,1,0,'C',true); //Grounding values
           $fpdf->Cell(20, 6, $row->pembumian_defect_other ,1,0,'C',true);

           $fpdf->Cell(55, 6, $row->bekalan_dua_defect_damage ,1,0,'C',true);   //Signage - OFF Point / Two Way Supply values
           $fpdf->Cell(20, 6, $row->bekalan_dua_defect_other ,1,0,'C',true);
            // table # 4 body values end




           $fpdf->Ln();
           $fpdf->Ln();

           // table # 5 header 1/2
           $fpdf->SetFillColor(169, 169, 169);

           $fpdf->Cell(95, 6, "Main Street" ,1,0,'C',true);
           $fpdf->Cell(95, 6, "Site Conditions" ,1,0,'C',true);
           $fpdf->Cell(80, 6, "Area" ,1,0,'C',true);




           $fpdf->Ln();
           // table # 5 header 1/2

           $fpdf->Cell(30, 6, "Date Wire" ,1,0,'C',true);           // Msin Street
           $fpdf->Cell(45, 6, "Junction Box Date / Burn Effect" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);

           $fpdf->Cell(35, 6, "Crossing the Road" ,1,0,'C',true);       //Site Conditions
           $fpdf->Cell(20, 6, "Sidewalk" ,1,0,'C',true);
           $fpdf->Cell(40, 6, "No vehicle entry area" ,1,0,'C',true);

           $fpdf->Cell(20, 6, "Bend" ,1,0,'C',true);        // Area
           $fpdf->Cell(20, 6, "Road" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Forest" ,1,0,'C',true);
           $fpdf->Cell(20, 6, "Others" ,1,0,'C',true);




           // table # 5 header 1/2 end
           $fpdf->Ln();


           // table # 5 body start
           $fpdf->SetFillColor(255, 255, 255);

           $fpdf->Cell(30, 6, $row->kaki_lima_defect_date_wire ,1,0,'C',true);                           // Main Street Values
           $fpdf->Cell(45, 6, $row->kaki_lima_defect_burn ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->kaki_lima_defect_other ,1,0,'C',true);

           $fpdf->Cell(35, 6, $row->tapak_condition_road ,1,0,'C',true);       //Site Conditions values
           $fpdf->Cell(20, 6, $row->tapak_condition_side_walk ,1,0,'C',true);
           $fpdf->Cell(40, 6, $row->tapak_condition_vehicle_entry ,1,0,'C',true);

           $fpdf->Cell(20, 6, $row->kawasan_bend ,1,0,'C',true);        // Area values
           $fpdf->Cell(20, 6, $row->kawasan_road ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->kawasan_forest ,1,0,'C',true);
           $fpdf->Cell(20, 6, $row->kawasan_other ,1,0,'C',true);

           // table # 5 body end






           $fpdf->Ln();
           $fpdf->Ln();





           $fpdf->SetFillColor(169, 169, 169);




            $len = 0 ;
            foreach ($img_arr as $value) 
            {
                foreach ($value['defects'] as $defect) // run loop for defects
                { 
                    $defectName = $value['defect_name'].'_'.$defect;   // name that get from DB::raw(made up name)
                    $defectImage = $value['defect_name'].'_image';     // image name that is in db > image column > json

                    if ($row->{$defectName} == 'Yes' && $row->{$defectImage} != '') // check if defect is 'Yes' and Defect Image column is  not empty 
                    {
                         
                      $json_dec = json_decode($row->{$defectImage});    // image column is json so decode json

                        

                        if (is_object($json_dec)) {
                            // Access the property using -> (object syntax)
                            $imagePath = isset($json_dec->{$defect}) ? $json_dec->{$defect} : '';
                        } elseif (is_array($json_dec)) {
                            // Access the property using array syntax
                            $imagePath = isset($json_dec[$defect]) ? $json_dec[$defect] : '';
                        }

                        if ($imagePath && file_exists(public_path($imagePath))) // check image path is not empty and image exists
                        { 
                            $fpdf->Image(public_path($imagePath), $fpdf->GetX()+2, $fpdf->GetY()+8, 19, 18); //add image
                        }

                        $fpdf->Cell(25, 7, $value['title'].' '.$defect, 1);
                        $len = $len + 25;
                    }
               
                    if ($len == 275) 
                    {
                        $len = 0 ;
                        $fpdf->Ln(); $fpdf->Ln(); $fpdf->Ln(); $fpdf->Ln();
                    }

                }

            }

            


            foreach ($imageSingle as $sinVal) {
                if ($len == 275) {
                    $len = 0 ;
                        $fpdf->Ln();
                        $fpdf->Ln();
                        $fpdf->Ln();
                        $fpdf->Ln();
    
                   }
    
 
                if ($row->{$sinVal['arr']} == 'Yes' && $row->{$sinVal['key']} != '' ) {
             
            
                    $imagePath = $row->{$sinVal['key']};
              
                    if (file_exists(public_path($imagePath))) {
                        // $fpdf->Cell(1);
                        $fpdf->Image(public_path($imagePath), $fpdf->GetX()+2, $fpdf->GetY()+8, 19, 18);

                        $fpdf->Cell(25, 7, $sinVal['name'], 1);
                $len = $len + 25;
                    } 
                

                } 

              


            }

            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();
            $fpdf->Ln();

         
        }
        
        $pdfFileName = 'TIANG - SAVR  ' . $req->ba . ' LKS ( ' . ($req->from_date ?? 'All') . ' - ' . ($req->to_date ?? 'All') . ' ).pdf';
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
        return  $fpdf->output('D', $pdfFileName );
     }
}






                // ['name'=>'Pole Cracked' , 'key'=>'cracked' , 'arr'=>'tiang_defect_image' , 'defect_arr' => 'tiang_defect_cracked'],
                // ['name'=>'Pole leaning ' , 'key'=>'leaning' , 'arr'=>'tiang_defect_image', 'defect_arr' => 'tiang_defect_leaning'],
                // ['name'=>'Pole dim' , 'key'=>'dim' , 'arr'=>'tiang_defect_image','defect_arr' => 'tiang_defect_dim'],
                // ['name'=>'Pole creepers' , 'key'=>'creepers' , 'arr'=>'tiang_defect_image','defect_arr' => 'tiang_defect_creepers'],
                // ['name'=>'Pole other' , 'key'=>'other' , 'arr'=>'tiang_defect_image','defect_arr' => 'tiang_defect_other'],


                // ['name'=>'Line Joint' , 'key'=>'joint' , 'arr'=>'talian_defect_image','defect_arr' => 'talian_defect_joint'],
                // ['name'=>'Line Rentis' , 'key'=>'need_rentis' , 'arr'=>'talian_defect_image','defect_arr' => 'talian_defect_need_rentis'],
                // ['name'=>'Line Ground clr' , 'key'=>'ground' , 'arr'=>'talian_defect_image','defect_arr' => 'talian_defect_ground'],
                // ['name'=>'Line other' , 'key'=>'other' , 'arr'=>'talian_defect_image','defect_arr' => 'talian_defect_other'],

                // ['name'=>'Umbang breaking' , 'key'=>'breaking' , 'arr'=>'umbang_defect_image','defect_arr' => 'umbang_defect_breaking'],
                // ['name'=>'Umbang creepers' , 'key'=>'creepers' , 'arr'=>'umbang_defect_image','defect_arr' => 'umbang_defect_creepers'],
                // ['name'=>'Umbang cracked' , 'key'=>'cracked' , 'arr'=>'umbang_defect_image','defect_arr' => 'umbang_defect_cracked'],
                // ['name'=>'Umbang stay_palte' , 'key'=>'stay_palte' , 'arr'=>'umbang_defect_image','defect_arr' => 'umbang_defect_stay_palte'],
                // ['name'=>'Umbang other' , 'key'=>'other' , 'arr'=>'umbang_defect_image','defect_arr' => 'umbang_defect_other'],

                // ['name'=>'IPC Burn' , 'key'=>'burn' , 'arr'=>'ipc_defect_image','defect_arr' => 'ipc_defect_burn'],
                // ['name'=>'IPC other' , 'key'=>'other' , 'arr'=>'ipc_defect_image','defect_arr' => 'ipc_defect_other'],

                // ['name'=>'Blackbox cracked' , 'key'=>'cracked' , 'arr'=>'blackbox_defect_image','defect_arr' => 'blackbox_defect_cracked'],
                // ['name'=>'Blackbox other' , 'key'=>'other' , 'arr'=>'blackbox_defect_image','defect_arr' => 'blackbox_defect_other'],

                // ['name'=>'Jumper sleeve' , 'key'=>'sleeve' , 'arr'=>'jumper_image','defect_arr' => 'jumper_sleeve'],
                // ['name'=>'Jumper burn' , 'key'=>'burn' , 'arr'=>'jumper_image','defect_arr' => 'jumper_burn'],
                // ['name'=>'Jumper other' , 'key'=>'other' , 'arr'=>'jumper_image','defect_arr' => 'jumper_other'],

                // ['name'=>'Lightning broken' , 'key'=>'broken' , 'arr'=>'kilat_defect_image','defect_arr' => 'kilat_defect_broken'],
                // ['name'=>'Lightning other' , 'key'=>'other' , 'arr'=>'kilat_defect_image','defect_arr' => 'kilat_defect_other'],


                // ['name'=>'Service roof' , 'key'=>'roof' , 'arr'=>'servis_defect_image','defect_arr' => 'servis_defect_roof'],
                // ['name'=>'Service won_piece' , 'key'=>'won_piece' , 'arr'=>'servis_defect_image','defect_arr' => 'servis_defect_won_piece'],
                // ['name'=>'Service other' , 'key'=>'other' , 'arr'=>'servis_defect_image','defect_arr' => 'servis_defect_other'],

                // ['name'=>'Grounding netural' , 'key'=>'netural' , 'arr'=>'pembumian_defect_image','defect_arr' => 'pembumian_defect_netural'],
                // ['name'=>'Grounding other' , 'key'=>'other' , 'arr'=>'pembumian_defect_image','defect_arr' => 'pembumian_defect_other'],

                // ['name'=>'Signage damage' , 'key'=>'damage' , 'arr'=>'bekalan_dua_defect_image','defect_arr' => 'bekalan_dua_defect_damage'],
                // ['name'=>'Signage other' , 'key'=>'other' , 'arr'=>'bekalan_dua_defect_image','defect_arr' => 'bekalan_dua_defect_other'],
           
                // ['name'=>'Main St. date_wire' , 'key'=>'date_wire' , 'arr'=>'kaki_lima_defect_image','defect_arr' => 'kaki_lima_defect_date_wire'],
                // ['name'=>'Main St. burn' , 'key'=>'burn' , 'arr'=>'kaki_lima_defect_image','defect_arr' => 'kaki_lima_defect_burn'],
                // ['name'=>'Main St. other' , 'key'=>'other' , 'arr'=>'kaki_lima_defect_image','defect_arr' => 'kaki_lima_defect_other'],






 // if ($row->{$value['defect']} == 'Yes' && $row->{$value['arr']} != '') {
                //     $json_dec = json_decode($row->{$value['arr']});
            
                //     // Check if $json_dec is an object
                //     if (is_object($json_dec)) {
                //         // Access the property using -> (object syntax)
                //         $imagePath = isset($json_dec->{$value['key']}) ? $json_dec->{$value['key']} : '';
                //     } elseif (is_array($json_dec)) {
                //         // Access the property using array syntax
                //         $imagePath = isset($json_dec[$value['key']]) ? $json_dec[$value['key']] : '';
                //     }
            
                //     if ($imagePath && file_exists(public_path($imagePath))) {
                //         // $fpdf->Cell(1);
                //         $fpdf->Image(public_path($imagePath), $fpdf->GetX()+2, $fpdf->GetY()+8, 19, 18);

                //     } else {
                //         // $fpdf->Cell(23);

                //         // $fpdf->Cell(23, 7, 'no image found', 1);
                //     }
                // $fpdf->Cell(25, 7, $value['name'], 1);
                // $len = $len + 25;

                // } else {

                //     // $fpdf->Cell(23);

                //     // $fpdf->Cell(23, 7, 'no image found', 1);
                // }
