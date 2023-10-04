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

    public function generateTiangExcel()
    {
        try {
            $recored = Tiang::all();
            // return $recored;
            if (sizeof($recored) > 0) {
                $excelFile = public_path('assets/excel-template/QR TIANG.xlsx');

                $spreadsheet = IOFactory::load($excelFile);

                $worksheet = $spreadsheet->getSheet(0);

                $i = 8;
                foreach ($recored as $rec) {
                    $worksheet->setCellValue('B' . $i, $i - 7);
                    $worksheet->setCellValue('D' . $i, $rec->fp_name);
                    $worksheet->setCellValue('F' . $i, $rec->fp_road);
                    $worksheet->setCellValue('I' . $i, $rec->section_from);
                    $worksheet->setCellValue('J' . $i, $rec->section_to);

                    if ($rec->size_tiang != '') {
                        $size_tiang = json_decode($rec->size_tiang);

                        $worksheet->setCellValue('L' . $i, $size_tiang->st7);
                        $worksheet->setCellValue('M' . $i, $size_tiang->st9);
                        $worksheet->setCellValue('N' . $i, $size_tiang->st10);
                    }

                    if ($rec->jenis_tiang != '') {
                        $jenis_tiang = json_decode($rec->jenis_tiang);

                        $worksheet->setCellValue('O' . $i, $jenis_tiang->spun);
                        $worksheet->setCellValue('P' . $i, $jenis_tiang->concrete);
                        $worksheet->setCellValue('Q' . $i, $jenis_tiang->iron);
                        $worksheet->setCellValue('R' . $i, $jenis_tiang->wood);
                    }

                    if ($rec->abc_span != '') {
                        $abc_span = json_decode($rec->abc_span);

                        $worksheet->setCellValue('T' . $i, $abc_span->s3_185);
                        $worksheet->setCellValue('U' . $i, $abc_span->s3_95);
                        $worksheet->setCellValue('V' . $i, $abc_span->s3_16);
                        $worksheet->setCellValue('W' . $i, $abc_span->s1_16);
                    }

                    if ($rec->pvc_span != '') {
                        $pvc_span = json_decode($rec->pvc_span);

                        $worksheet->setCellValue('X' . $i, $pvc_span->s19_064);

                        $worksheet->setCellValue('Y' . $i, $pvc_span->s7_083);
                        $worksheet->setCellValue('Z' . $i, $pvc_span->s7_044);
                    }

                    if ($rec->bare_span != '') {
                        $bare_span = json_decode($rec->bare_span);

                        $worksheet->setCellValue('AA' . $i, $bare_span->s7_173);
                        $worksheet->setCellValue('AB' . $i, $bare_span->s7_122);
                        $worksheet->setCellValue('AC' . $i, $bare_span->s3_132);
                    }

                    $worksheet->setCellValue('AK' . $i, $rec->remarks);

                    $i++;
                }
                $worksheet->calculateColumnWidths();
                // SHeet 2

                $i = 8;
                $secondWorksheet = $spreadsheet->getSheet(1);
                foreach ($recored as $rec) {
                    $secondWorksheet->setCellValue('B' . $i, $i - 7);
                    $secondWorksheet->setCellValue('C' . $i, $rec->fp_name);
                    $secondWorksheet->setCellValue('D' . $i, $rec->fp_road);
                    $secondWorksheet->setCellValue('E' . $i, $rec->section_from);
                    $secondWorksheet->setCellValue('F' . $i, $rec->section_to);
                    $secondWorksheet->setCellValue('M' . $i, $rec->tiang_no);

                    if ($rec->tiang_defect != '') {
                        
                        $secondWorksheet->setCellValue('N' . $i, excelCheckBOc('cracked', $rec->tiang_defect));
                        $secondWorksheet->setCellValue('O' . $i, excelCheckBOc('leaning', $rec->tiang_defect));
                        $secondWorksheet->setCellValue('P' . $i, excelCheckBOc('dim', $rec->tiang_defect));
                    }

                    if ($rec->talian_defect != '') {
                        $secondWorksheet->setCellValue('Q' . $i, excelCheckBOc('joint', $rec->talian_defect));
                        $secondWorksheet->setCellValue('R' . $i, excelCheckBOc('need_rentis', $rec->talian_defect));
                        $secondWorksheet->setCellValue('S' . $i, excelCheckBOc('ground', $rec->talian_defect));
                    }

                    if ($rec->umbang_defect != '') {
                        $secondWorksheet->setCellValue('T' . $i, excelCheckBOc('breaking', $rec->umbang_defect));
                        $secondWorksheet->setCellValue('U' . $i, excelCheckBOc('creepers', $rec->umbang_defect));
                        $secondWorksheet->setCellValue('V' . $i, excelCheckBOc('cracked', $rec->umbang_defect));
                        $secondWorksheet->setCellValue('W' . $i, excelCheckBOc('stay_palte', $rec->umbang_defect));
                    }

                    if ($rec->ipc_defect != '') {
                        $secondWorksheet->setCellValue('X' . $i, excelCheckBOc('burn', $rec->ipc_defect));
                    }

                    if ($rec->blackbox_defect != '') {
                        $secondWorksheet->setCellValue('Y' . $i, excelCheckBOc('burn', $rec->blackbox_defect));
                    }

                    if ($rec->jumper != '') {
                        $secondWorksheet->setCellValue('Z' . $i, excelCheckBOc('sleeve', $rec->jumper));
                        $secondWorksheet->setCellValue('AA' . $i, excelCheckBOc('burn', $rec->jumper));
                    }

                    if ($rec->kilat_defect != '') {
                        $secondWorksheet->setCellValue('AB' . $i, excelCheckBOc('broken', $rec->kilat_defect));
                    }

                    if ($rec->servis_defect != '') {
                        $secondWorksheet->setCellValue('AC' . $i, excelCheckBOc('roof', $rec->servis_defect));
                        $secondWorksheet->setCellValue('AD' . $i, excelCheckBOc('won_piece', $rec->servis_defect));
                    }

                    if ($rec->pembumian_defect != '') {
                        $secondWorksheet->setCellValue('AE' . $i, excelCheckBOc('netural', $rec->pembumian_defect));
                    }

                    if ($rec->bekalan_dua_defect != '') {
                        $secondWorksheet->setCellValue('AF' . $i, excelCheckBOc('damage', $rec->bekalan_dua_defect));
                    }

                    if ($rec->kaki_lima_defect != '') {
                        $secondWorksheet->setCellValue('AG' . $i, excelCheckBOc('date_wire', $rec->kaki_lima_defect));
                        $secondWorksheet->setCellValue('AH' . $i, excelCheckBOc('burn', $rec->kaki_lima_defect));
                    }
                    $secondWorksheet->setCellValue('AI' . $i, $rec->total_defects);
                    $secondWorksheet->setCellValue('AJ' . $i, date('Y-m-d', strtotime($rec->planed_date)));
                    $secondWorksheet->setCellValue('AK' . $i, date('Y-m-d', strtotime($rec->actual_date)));
                    $secondWorksheet->setCellValue('AL' . $i, $rec->remarks);
                }
                $secondWorksheet->calculateColumnWidths();
                //sheet 3

                //$i = 11

                $i = 11;
                $thirdWorksheet = $spreadsheet->getSheet(2);
                foreach ($recored as $rec) {
                    $thirdWorksheet->setCellValue('B' . $i, $i - 10);

                    if ($rec->tapak_condition != '') {
                        $thirdWorksheet->setCellValue('E' . $i, excelCheckBOc('road', $rec->tapak_condition));
                        $thirdWorksheet->setCellValue('F' . $i, excelCheckBOc('side_walk', $rec->tapak_condition));
                        $thirdWorksheet->setCellValue('G' . $i, excelCheckBOc('vehicle_entry', $rec->tapak_condition));
                    }

                    if ($rec->kawasan != '') {
                        $thirdWorksheet->setCellValue('H' . $i, excelCheckBOc('bend', $rec->kawasan));
                        $thirdWorksheet->setCellValue('I' . $i, excelCheckBOc('raod', $rec->kawasan));
                        $thirdWorksheet->setCellValue('J' . $i, excelCheckBOc('forest', $rec->kawasan));
                        $thirdWorksheet->setCellValue('K' . $i, excelCheckBOc('other', $rec->kawasan));
                    }

                    $thirdWorksheet->setCellValue('K' . $i, $rec->jarak_kelegaan);

                    if ($rec->talian_spec != '') {
                        $thirdWorksheet->setCellValue('M' . $i, excelCheckBOc('comply', $rec->talian_spec));
                        $thirdWorksheet->setCellValue('N' . $i, excelCheckBOc('disobedient', $rec->talian_spec));
                    }

                    $i++;
                }
                $thirdWorksheet->calculateColumnWidths();  
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

                $writer->save(public_path('assets/updated-excels/') . 'qr-tiang-talian.xlsx');
                ob_end_clean();
                return response()->download(public_path('assets/updated-excels/') . 'qr-tiang-talian.xlsx');
            } else {
                return redirect()
                    ->back()
                    ->with('failed', 'No records found ');
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()
                ->back()
                ->with('failed', 'Request Failed');
        }
    }
}
