<?php

namespace App\Http\Controllers\web\excel;

use App\Http\Controllers\Controller;
use App\Models\ThirdPartyDiging;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;

class ThirdPartyExcelController extends Controller
{
    public function generateThirdPartExcel(Request $req)
    {

        // return $req;
        $userBa = Auth::user()->ba == '' ? $req->excelBa : Auth::user()->ba;
        $zone = Auth::user()->zone  == '' ? $req->excelZone : Auth::user()->zone;
        $surveyDate_from = $req->excel_from_date == "" ? ThirdPartyDiging::min('survey_date') : $req->excel_from_date;
        $surveyDate_to = $req->excel_to_date == "" ? ThirdPartyDiging::max('survey_date') : $req->excel_to_date;

        // return $surveyDate_to;
        try {
            $recored = ThirdPartyDiging::where('ba' ,  'LIKE', '%' . $userBa . '%')
                    ->where('zone' ,  'LIKE', '%' . $zone . '%')
                    ->whereDate("survey_date" ,">=" , $surveyDate_from)
                    ->whereDate("survey_date" ,"<=" , $surveyDate_to)
                    ->get();
            // return $recored;
            if (sizeof($recored) > 0) {
                $excelFile = public_path('assets/excel-template/test.xlsx');

                $spreadsheet = IOFactory::load($excelFile);

                $worksheet = $spreadsheet->getActiveSheet();

                $i = 3;
                foreach ($recored as $rec) {
                    $worksheet->setCellValue('A' . $i, $i - 3);
                    $worksheet->setCellValue('B' . $i, $rec->wp_name);
                    $worksheet->setCellValue('C' . $i, $rec->zone);
                    $worksheet->setCellValue('D' . $i, $rec->ba);
                    $worksheet->setCellValue('E' . $i, $rec->team_name);
                    $worksheet->setCellValue('F' . $i, date('Y-m-d', strtotime($rec->survey_date)));
                    $worksheet->setCellValue('G' . $i, date('H:i:s', strtotime($rec->patrolling_time)));
                    $worksheet->setCellValue('H' . $i, $rec->road_name);
                    $worksheet->setCellValue('I' . $i, $rec->project_name);
                    $worksheet->setCellValue('J' . $i, $rec->feeder_involved);
                    // $worksheet->setCellValue('K' . $i, $rec->km_plan);
                    // $worksheet->setCellValue('L' . $i, $rec->km_actual);
                    $worksheet->setCellValue('K' . $i, $rec->digging);
                    $worksheet->setCellValue('L' . $i, $rec->notice);

                    $worksheet->setCellValue('M' . $i, $rec->supervision);
                    $worksheet->setCellValue('N' . $i, $rec->company_name);
                    $worksheet->setCellValue('O' . $i, $rec->office_phone_no);

                    $worksheet->setCellValue('P' . $i, $rec->main_contractor);

                    $worksheet->setCellValue('Q' . $i, $rec->developer_phone_no);

                    $worksheet->setCellValue('R' . $i, $rec->contractor_company_name);

                    $worksheet->setCellValue('S' . $i, $rec->site_supervisor_name);
                    $worksheet->setCellValue('T' . $i, $rec->site_supervisor_phone_no);
                    $worksheet->setCellValue('U' . $i, $rec->excavator_operator_name);
                    $worksheet->setCellValue('V' . $i, $rec->excavator_machinery_reg_no);

                    $i++;
                }
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

                $writer->save(public_path('assets/updated-excels/') . 'qr-third-party-digging.xlsx');
               // ob_end_clean();
                return response()->download(public_path('assets/updated-excels/') . 'qr-third-party-digging.xlsx');
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
