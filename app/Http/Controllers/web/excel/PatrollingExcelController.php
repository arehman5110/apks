<?php

namespace App\Http\Controllers\web\excel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patroling;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PatrollingExcelController extends Controller
{

    public function generateExcel(Request $req)
    {

        // return $req;
        $userBa = '%';
        $zone = '%';
        $surveyDate_from = $req->excel_from_date == "" ? Patroling::min('date') : $req->excel_from_date;
        $surveyDate_to = $req->excel_to_date == "" ? Patroling::max('date') : $req->excel_to_date;

        // return $surveyDate_to;
        try {
            $recored = Patroling::
                    whereDate("date" ,">=" , $surveyDate_from)
                    ->whereDate("date" ,"<=" , $surveyDate_to)->select('wp_name' , 'ba' ,'zone' , 'date' , 'time' , 'km')
                    ->get();


            if (sizeof($recored) > 0) {
                $excelFile = public_path('assets/excel-template/patrolling-template.xlsx');


                $spreadsheet = IOFactory::load($excelFile);

                $worksheet = $spreadsheet->getActiveSheet();

                $i = 3;
                foreach ($recored as $rec) {
                    $worksheet->setCellValue('A' . $i, $i - 2);
                    $worksheet->setCellValue('B' . $i, $rec->wp_name);
                    $worksheet->setCellValue('C' . $i, $rec->zone);
                    $worksheet->setCellValue('D' . $i, $rec->ba);
                    $worksheet->setCellValue('E' . $i, date('Y-m-d', strtotime($rec->date)));
                    $worksheet->setCellValue('F' . $i, date('H:i:s', strtotime($rec->time)));
                    $worksheet->setCellValue('G' . $i, $rec->km);

                    $i++;
                }
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

                $writer->save(public_path('assets/updated-excels/') . 'patrolling.xlsx');
                // return $recored;
               // ob_end_clean();
                return response()->download(public_path('assets/updated-excels/') . 'patrolling.xlsx');
            } else {
                return redirect()
                    ->back()
                    ->with('failed', 'No records found ');
            }
        } catch (\Throwable $th) {
           // return $th->getMessage();
            return redirect()
                ->back()
                ->with('failed', 'Request Failed');
        }
    }
}
