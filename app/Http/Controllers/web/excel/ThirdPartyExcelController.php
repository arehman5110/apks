<?php

namespace App\Http\Controllers\web\excel;

use App\Http\Controllers\Controller;
use App\Models\ThirdPartyDiging;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ThirdPartyExcelController extends Controller
{
    public function generateCableBridgeExcel()
    {
        try {
            $recored = ThirdPartyDiging::all();
            // return $recored;
            if (sizeof($recored) > 0) {
                $excelFile = public_path('assets/excel-template/cable-bridge.xlsx');

                $spreadsheet = IOFactory::load($excelFile);

                $worksheet = $spreadsheet->getActiveSheet();

                $i = 4;
                foreach ($recored as $rec) {
                    $worksheet->setCellValue('A' . $i, $i - 3);
                    $worksheet->setCellValue('B' . $i, $rec->zone);
                    $worksheet->setCellValue('C' . $i, $rec->ba);
                    $worksheet->setCellValue('D' . $i, $rec->team);
                    $worksheet->setCellValue('E' . $i, $rec->visit_date);
                    $worksheet->setCellValue('F' . $i, $rec->patrol_time);
                    $worksheet->setCellValue('G' . $i, $rec->feeder_involved);
                    $worksheet->setCellValue('H' . $i, $rec->aera);
                    $worksheet->setCellValue('I' . $i, $rec->start_date);
                    $worksheet->setCellValue('J' . $i, $rec->end_date);
                    $worksheet->setCellValue('K' . $i, $rec->voltage);
                    $worksheet->setCellValue('L' . $i, $rec->coordinate);
                    $worksheet->setCellValue('M' . $i, $rec->vandalism_status);
                    $worksheet->setCellValue('N' . $i, $rec->pipe_staus);

                    $worksheet->setCellValue('O' . $i, $rec->collapsed_status);
                    $worksheet->setCellValue('P' . $i, $rec->rust_status);
                    $worksheet->setCellValue('Q' . $i, $rec->bushes_status);

                    $i++;
                }

                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

                $writer->save(public_path('assets/updated-excels/') . 'cable-bridge.xlsx');

                return response()->download(public_path('assets/updated-excels/') . 'cable-bridge.xlsx');
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