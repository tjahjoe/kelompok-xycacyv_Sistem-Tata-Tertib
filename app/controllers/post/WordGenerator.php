<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

use PhpOffice\PhpWord\TemplateProcessor;

function generateWordFromTemplate()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $templateFilePath = __DIR__ . "/../../../assets/word/surat_peringatan.docx"; 
        $tempDocxFile = __DIR__ . "/../../../assets/word/temp.docx";

        $templateProcessor = new TemplateProcessor($templateFilePath);

        $templateProcessor->setValue('nama', ucwords($_POST['nama']));
        $templateProcessor->setValue('nim', $_POST['nim']);
        $templateProcessor->setValue('jurusan', 'Teknik Informatika');
        $templateProcessor->setValue('alamat', 'Jl. Contoh No. 123');
        $templateProcessor->setValue('tanggal', '23 November 2024');
        $templateProcessor->setValue('perguruan', 'Politeknik Negeri Malang');

        $templateProcessor->saveAs($tempDocxFile);

        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Disposition: attachment; filename=surat_pernyataan.docx");
        readfile($tempDocxFile);

        unlink($tempDocxFile);
    }
}
?>