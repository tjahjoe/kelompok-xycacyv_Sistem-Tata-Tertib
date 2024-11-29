<?php
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../../assets/utils/setData.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $userModel = new User();

    $response = [
        'status' => 'error',
        'message' => 'process failed',
    ];

    $id = $_SESSION['user']['id_users'];

    $lastFileName = $userModel->checkPhotoName($id);
    // var_dump($lastFileName);
    if ($lastFileName) {
        if ($lastFileName['foto_diri'] != null) {
            $targetDirectory = "../../assets/uploads/photo/";
            unlink($targetDirectory . $lastFileName['foto_diri']);
        }
    }

    $fileName = changePhotoProfil($id);

    $result = $userModel->changeFoto($id, $fileName);

    echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
    exit;





    // $condition = true;

    // if (!$isEmptyImg) {
    //     $maxsize = 3 * 1024 * 1024;
    //     $condition = array_sum($_FILES['lampiran']['size']) <= $maxsize && count($_FILES['lampiran']['name']) <= 10 ? true : false;
    // }

    // // echo "p1";
    // $checkNim = $mahasiswaModel->getDataMahasiswa($nim);
    
    // $message = '';
    // if (empty($checkNim)) {
    //     $message = "nim not valid";
    // } else if (!$condition) {
    //     $message = "image size is too large";
    // }

    // if ($checkNim && $condition) {
    //     // echo "p2";
    //     $idPelanggaranMhs = $pelanggaranMahasiswaModel->uploadPelanggaran(
    //         $nim,
    //         $tanggal,
    //         $catatan,
    //         $pelapor,
    //         $jenis,
    //         $isEmptyImg
    //     );

    //     // echo json_encode($idPelanggaranMhs);
    //     if ($idPelanggaranMhs) {

    //         $files = uploadImage($idPelanggaranMhs);
    //         $result = $pelanggaranMahasiswaModel->uploadImages($files, $idPelanggaranMhs['id_pelanggaran_mhs']);

    //         // echo json_encode($result);
    //         echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
    //         exit;
    //     } else {
    //         echo json_encode(['status' => 'success', 'message' => 'upload success']);
    //         exit;
    //     }
    // } else {
    //     // echo "p3";
    //     $response['message'] = $message;
    //     echo json_encode($response);
    //     exit;
    // }
}
?>