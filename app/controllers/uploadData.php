<?php
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

    $response = [
        'status' => 'error',
        'message' => 'Email or Password is incorrect!',
    ];

    $nim = $_POST['nim'];   
    $tingkat = $_POST['tingkat'];
    $jenis = $_POST['jenis'];
    $catatan = $_POST['catatan'];
    $tanggal = $_POST['tanggal'];
    $pelapor = $_SESSION['user']['id_users'];
    $isEmptyImg = empty($_FILES['files']['name'][0]);

    $idPelanggaranMhs = $pelanggaranMahasiswaModel->uploadPelanggaran(
        $nim,
        $tanggal,
        $catatan,
        $pelapor,
        $jenis,
        $isEmptyImg
    );

    if ($idPelanggaranMhs) {
        $targetDirectory = "../../assets/uploads/";
        $totalFiles = count($_FILES['files']['name']);

        $files = [];
        
        for ($i = 0; $i < $totalFiles; $i++) {
            $file = explode('.', $_FILES['files']['name'][$i]);
            $type = end($file); 
            $fileName = $idPelanggaranMhs['id_pelanggaran_mhs'] . $i . ".$type";
            $targetFile = $targetDirectory . $fileName;
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
                // echo "File $fileName berhasil diunggah.<br>";
                $files[] = $fileName;
            } else {
                // echo "Gagal mengunggah file $fileName.<br>";
            }
        }

        $files = implode(',', $files);
        $result = $pelanggaranMahasiswaModel->uploadImages($files, $idPelanggaranMhs['id_pelanggaran_mhs']);

        echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
    } else {
        echo  json_encode(['status' => 'success', 'message' => 'upload success']);
    }
}
?>