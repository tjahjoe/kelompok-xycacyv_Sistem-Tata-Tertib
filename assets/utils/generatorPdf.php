<?php
require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../vendor/tecnickcom/tcpdf/tcpdf.php";

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
function pdfGenerator (){
    $templateFilePath = __DIR__ . "/../word/tamplate.docx";

    $templateProcessor = new TemplateProcessor($templateFilePath);
    
    $templateProcessor->setValue('nama', 'Welcome to PHPWord');
    $templateProcessor->setValue('content', 'This document will be displayed as a PDF in the browser.');
    
    $tempDocxFile = __DIR__ . "/temp.docx";
    $templateProcessor->saveAs($tempDocxFile);
    
    $phpWord = IOFactory::load($tempDocxFile);
    $tempHtmlFile = __DIR__ . "/temp.html";
    $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
    $htmlWriter->save($tempHtmlFile);
    
    $htmlContent = file_get_contents($tempHtmlFile);
    
    ob_clean();
    
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Custom Author');
    $pdf->SetTitle('Custom PDF Title');
    $pdf->SetSubject('surat kuesioner');
    $pdf->setPrintHeader(false);
    $pdf->AddPage();
    
    $pdf->SetFont('helvetica', 'B', 16); 
    
    $pdf->writeHTML($htmlContent, true, false, true, false);
    
    $pdf->Output('document.pdf', 'I');
    
    unlink($tempDocxFile);
    unlink($tempHtmlFile);
}
?>