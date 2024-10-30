<?php
function uploadFiles($files){
    $directory = '../uploads';
    $totalFiles = count($files);
    for ($i=0; $i < $totalFiles ; $i++) { 
        $fileName = $_FILES['files']['name'][$i];   
        $targetFile = $directory . $fileName;

        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
            echo "File $fileName berhasil diunggah.<br>";
        } else {
            echo "Gagal mengunggah file $fileName.<br>";
        }
    }
}
?>