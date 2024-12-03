<?php
require_once __DIR__ . "/../utils/uploadFile.php";
function updateSuratPeringatan()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $targetDirectory = "../../assets/word/";
        // $fileName = "tamplate.docx";

        // if (file_exists($targetDirectory . $fileName)) {
        //     unlink($targetDirectory . $fileName);
        // }

        // $targetFile = $targetDirectory . $fileName;
        // move_uploaded_file($_FILES['surat']['tmp_name'], $targetFile);

        $sizeImage = $_FILES['surat']['size'];
        $maxsize = 5 * 1024 * 1024;

        $checkSize = $sizeImage <= $maxsize ? true : false;

        if ($checkSize) {
            changeSuratPeringatan();

            echo json_encode(['status' => 'success', 'message' => 'update success']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal: Batas maksimal ukuran file 5MB']);
            exit;
        }
    }
}
?>