<?php
function updateSuratPeringatan()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $targetDirectory = "../../assets/word/";
        $fileName = "tamplate.docx";

        if (file_exists($targetDirectory . $fileName)) {
            unlink($targetDirectory . $fileName);
        }

        $targetFile = $targetDirectory . $fileName;
        move_uploaded_file($_FILES['surat']['tmp_name'], $targetFile);

        echo json_encode(['status' => 'success', 'message' => 'update success']);
        exit;
    }
}
?>