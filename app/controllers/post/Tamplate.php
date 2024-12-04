<?php
require_once __DIR__ . "/../utils/uploadFile.php";
function updateSuratPeringatan()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sizeFile = $_FILES['surat']['size'];
        $maxsize = 5 * 1024 * 1024;

        $checkSize = $sizeFile <= $maxsize ? true : false;

        if ($checkSize) {
            changeSuratPeringatan();

            echo json_encode(['status' => 'success', 'message' => 'update success']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal: Batas maksimal ukuran file 5MB!']);
            exit;
        }
    }
}
?>