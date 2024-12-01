<?php
function uploadImage($idPelanggaranMhs)//untuk edit pp
{
    $targetDirectory = "../../assets/uploads/bukti/"; //edit path
    $totalFiles = count($_FILES['lampiran']['name']); //edit name

    $files = [];

    for ($i = 0; $i < $totalFiles; $i++) {
        $file = explode('.', $_FILES['lampiran']['name'][$i]);
        $type = end($file);
        $fileName = $idPelanggaranMhs['id_pelanggaran_mhs'] . $i . ".$type";
        $targetFile = $targetDirectory . $fileName;
        if (move_uploaded_file($_FILES['lampiran']['tmp_name'][$i], $targetFile)) {
            // echo "File $fileName berhasil diunggah.<br>";
            $files[] = $fileName;
        } else {
            // echo "Gagal mengunggah file $fileName.<br>";
        }
    }

    $files = implode(',', $files);
    return $files;
}

function changePhotoProfil($id)
{   
    $targetDirectory = "../../assets/uploads/photo/";

    $file = explode('.', $_FILES['photo']['name']);
    $type = end($file);
    $fileName = $id . ".$type";
    $targetFile = $targetDirectory . $fileName;
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
    return $fileName;
}

function changeSuratPeringatan(){
    $targetDirectory = __DIR__ . "/../../../assets/word/";
    $fileName = "surat_peringatan.docx";

    if (file_exists($targetDirectory . $fileName)) {
        unlink($targetDirectory . $fileName);
    }

    $targetFile = $targetDirectory . $fileName;
    move_uploaded_file($_FILES['surat']['tmp_name'], $targetFile);
}
?>