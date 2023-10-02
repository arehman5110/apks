<?php

namespace App\Http\Controllers\web\excel;


use App\Http\Controllers\Controller;
use App\Models\Substation;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class SubstationExcelController extends Controller
{
    //

    public function generateSubstationExcel()
    {
        try {
            $recored = Substation::all();
            // return $recored;
            if (sizeof($recored) > 0) {
                $excelFile = public_path('assets/excel-template/substation.xlsx');

                $spreadsheet = IOFactory::load($excelFile);

                $worksheet = $spreadsheet->getActiveSheet();

                $i = 4;
                foreach ($recored as $rec) {
                    $worksheet->setCellValue('A' . $i, $i - 3);
                    $worksheet->setCellValue('B' . $i, $rec->zone);
                    $worksheet->setCellValue('C' . $i, $rec->ba);
                    $worksheet->setCellValue('D' . $i, $rec->team);
                    $worksheet->setCellValue('E' . $i, date('Y-m-d', strtotime($rec->visit_date)) );
                    $worksheet->setCellValue('F' . $i, date('H:i:s', strtotime($rec->patrol_time)) );
                    $worksheet->setCellValue('G' . $i, $rec->fl);
                    $worksheet->setCellValue('H' . $i, $rec->voltage);
                    $worksheet->setCellValue('I' . $i, $rec->name);
                    $worksheet->setCellValue('J' . $i, $rec->type);
                    $worksheet->setCellValue('K' . $i, $rec->coordinate);

                    $worksheet->setCellValue('L' . $i, $rec->gate_status);
                    $worksheet->setCellValue('M' . $i, $rec->grass_status);
                    $worksheet->setCellValue('N' . $i, $rec->tree_branches_status);

                    $worksheet->setCellValue('O' . $i, $rec->building_status);
                    $worksheet->setCellValue('P' . $i, $rec->advertise_poster_status);

                    $i++;
                }

                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

                $writer->save(public_path('assets/updated-excels/') . 'substation.xlsx');

                return response()->download(public_path('assets/updated-excels/') . 'substation.xlsx');
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
