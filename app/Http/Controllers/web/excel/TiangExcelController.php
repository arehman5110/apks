<?php

namespace App\Http\Controllers\web\excel;

use App\Http\Controllers\Controller;
use App\Models\Tiang;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TiangExcelController extends Controller
{
    //

    public function generateDigingExcel()
    {
        $recored = Tiang::all();
        // return $recored;
        if (sizeof($recored) > 0) {

            $excelFile = public_path('assets/excel-template/QR Aero APKS.xlsx');

            $spreadsheet = IOFactory::load($excelFile);

            $worksheet = $spreadsheet->getActiveSheet(7);

            $cellValue = $worksheet->getCell('D6')->getValue();

            return response()->json([
                'statusCode' => 200,
                'success' => true,
                'data' => ['cellValue' => $cellValue],
                'message' => 'Excel cell value retrieved successfully',
            ]);
        }
    }
}
