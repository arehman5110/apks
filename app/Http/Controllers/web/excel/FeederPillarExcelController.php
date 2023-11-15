<?php

namespace App\Http\Controllers\web\excel;

use App\Http\Controllers\Controller;
use App\Models\FeederPillar;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;

class FeederPillarExcelController extends Controller
{
    //
    public function generateFeederPillarExcel(Request $req)
    {
        $userBa = Auth::user()->ba == '' ? $req->excelBa : Auth::user()->ba;
        $zone = Auth::user()->zone == '' ? $req->excelZone : Auth::user()->zone;
        $surveyDate_from = $req->excel_from_date == '' ? FeederPillar::min('visit_date') : $req->excel_from_date;
        $surveyDate_to = $req->excel_to_date == '' ? FeederPillar::max('visit_date') : $req->excel_to_date;

        try {
            $recored = FeederPillar::where('ba' ,  'LIKE', '%' . $userBa . '%')
            ->where('zone', 'LIKE', '%' . $zone . '%')
            ->whereDate('visit_date', '>=', $surveyDate_from)
            ->whereDate('visit_date', '<=', $surveyDate_to)->get();
            // return $recored;
            if (sizeof($recored) > 0) {
                $excelFile = public_path('assets/excel-template/feeder-pillar.xlsx');

                $spreadsheet = IOFactory::load($excelFile);

                $worksheet = $spreadsheet->getActiveSheet();

                $i = 3;
                foreach ($recored as $rec) {
                    $worksheet->setCellValue('A' . $i, $i - 3);

                    $worksheet->setCellValue('B' . $i, $rec->zone);
                    $worksheet->setCellValue('C' . $i, $rec->ba);
                    $worksheet->setCellValue('D' . $i, $rec->team);
                    $worksheet->setCellValue('E' . $i, date('Y-m-d', strtotime($rec->visit_date)) );
                    $worksheet->setCellValue('F' . $i, date('H:i:s', strtotime($rec->patrol_time)));
                    $worksheet->setCellValue('G' . $i, $rec->feeder_involved);
                    $worksheet->setCellValue('H' . $i, $rec->area);
                    $worksheet->setCellValue('I' . $i, $rec->size);
                    $worksheet->setCellValue('J' . $i, $rec->coordinate);
                    // $worksheet->setCellValue('K' . $i, $rec->gate_status);
                    $worksheet->setCellValue('L' . $i, $rec->vandalism_status);
                    $worksheet->setCellValue('M' . $i, $rec->leaning_staus);

                    $worksheet->setCellValue('N' . $i, $rec->rust_status);
                    $worksheet->setCellValue('O' . $i, $rec->advertise_poster_status);


                    $i++;
                }
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

            $writer->save(public_path('assets/updated-excels/') . 'qr-feeder-pillar.xlsx');
           // ob_end_clean();
            return response()->download(public_path('assets/updated-excels/'). 'qr-feeder-pillar.xlsx');
            } else {
                return redirect()
                    ->back()
                    ->with('failed', 'No records found ');
            }
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('failed', 'Request Failed');
        }
    }
}
