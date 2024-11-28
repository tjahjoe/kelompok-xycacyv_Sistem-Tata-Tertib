<?php
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/../models/Mahasiswa.php";
require_once __DIR__ . "/../../assets/utils/setData.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();
    $mahasiswaModel = new Mahasiswa();

    unset($_SESSION['allData']);

    $response = [
        'status' => 'error',
        'message' => 'data not valid',
    ];

    $nim = $_POST['nim'];
    // $tingkat = $_POST['tingkat'];
    $jenis = $_POST['jenisPelanggaran'];
    $catatan = $_POST['deskripsiLaporan'];
    // $tanggal = $_POST['tanggal'];
    $tanggal = date('Y-m-d');
    $pelapor = $_SESSION['user']['id_users'];
    $isEmptyImg = empty($_FILES['lampiran']['name'][0]);

    $condition = true;

    if (!$isEmptyImg) {
        $maxsize = 3 * 1024 * 1024;
        $condition = array_sum($_FILES['lampiran']['size']) <= $maxsize && count($_FILES['lampiran']['name']) <= 10 ? true : false;
    }

    // echo "p1";
    $checkNim = $mahasiswaModel->getDataMahasiswa($nim);
    
    $message = '';
    if (empty($checkNim)) {
        $message = "nim not valid";
    } else if (!$condition) {
        $message = "image size is too large";
    }

    if ($checkNim && $condition) {
        // echo "p2";
        $idPelanggaranMhs = $pelanggaranMahasiswaModel->uploadPelanggaran(
            $nim,
            $tanggal,
            $catatan,
            $pelapor,
            $jenis,
            $isEmptyImg
        );

        // echo json_encode($idPelanggaranMhs);
        if ($idPelanggaranMhs) {

            $files = uploadImage($idPelanggaranMhs);
            $result = $pelanggaranMahasiswaModel->uploadImages($files, $idPelanggaranMhs['id_pelanggaran_mhs']);

            // echo json_encode($result);
            echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
            exit;
        } else {
            echo json_encode(['status' => 'success', 'message' => 'upload success']);
            exit;
        }
    } else {
        // echo "p3";
        $response['message'] = $message;
        echo json_encode($response);
        exit;
    }
}
?>