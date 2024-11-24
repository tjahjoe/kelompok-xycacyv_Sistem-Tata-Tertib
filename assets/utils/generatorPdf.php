<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use PhpOffice\PhpWord\TemplateProcessor;

// function generateWordFromTemplate()
// {
// Define file paths
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $templateFilePath = __DIR__ . "/../word/surat_peringatan.docx"; // Path to your Word template
    $tempDocxFile = __DIR__ . "/temp.docx"; // Temporary edited Word file

    // Step 1: Load and Replace Word Template Placeholders
    $templateProcessor = new TemplateProcessor($templateFilePath);

    // Replace placeholders with actual values
    $templateProcessor->setValue('nama', $_POST['nama']);
    $templateProcessor->setValue('nim', $_POST['nim']);
    $templateProcessor->setValue('jurusan', 'Teknik Informatika');
    $templateProcessor->setValue('alamat', 'Jl. Contoh No. 123');
    $templateProcessor->setValue('tanggal', '23 November 2024');
    $templateProcessor->setValue('perguruan', 'Politeknik Negeri Malang');

    // Save the edited Word document to a temporary file
    $templateProcessor->saveAs($tempDocxFile);

    // Step 2: Serve the Word file to the browser as a download
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=surat_pernyataan.docx");
    readfile($tempDocxFile);

    // Step 3: Cleanup temporary file
    unlink($tempDocxFile);
}
// }

?>