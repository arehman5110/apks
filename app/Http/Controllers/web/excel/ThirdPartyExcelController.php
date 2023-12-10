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

        try{
        $ba = $req->filled('ba') ? $req->excelBa : Auth::user()->ba;
            $result = ThirdPartyDiging::query();

            if ($req->filled('excelBa')) {
                $result->where('ba', $ba);
            }

            if ($req->filled('excel_from_date')) {
                $result->where('survey_date', '>=', $req->excel_from_date);
            }

            if ($req->filled('surveyDate_to')) {
                $result->where('survey_date', '<=', $req->surveyDate_to);
            }


            $result = $result->get();
 
             
            if ($result) {
  
                $excelFile = public_path('assets/excel-template/test.xlsx');

                $spreadsheet = IOFactory::load($excelFile);

                $worksheet = $spreadsheet->getActiveSheet();

                $i = 3;
                foreach ($result as $rec) {
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
