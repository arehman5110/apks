<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\App;

class GenerateNoticePDFController extends Controller
{
    //
    function generateHtml(){


    }

    public function generatePdf()
    {

        $pdf = App::make('snappy.pdf.wrapper');
        
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->inline();
        
        $html = View::make('welcome')->render();
    
        // Generate PDF from HTML
        $pdf = PDF::loadHTML($html);
    
        // Get the temporary HTML file path
        $tempHtmlPath = tempnam(sys_get_temp_dir(), 'knp_snappy');
    
        // Save the HTML to the temporary file
        file_put_contents($tempHtmlPath, $html);
    
        // Get the public path for the output PDF file
        $outputPdfPath = public_path('pdfs/output.pdf');
    
        // Generate the PDF using the temporary HTML file
        $pdf->generate($tempHtmlPath, $outputPdfPath);
    
        // Clean up the temporary HTML file
        unlink($tempHtmlPath);
    
        // Return the PDF as a download
        return response()->download($outputPdfPath, 'output.pdf');
    }
}
