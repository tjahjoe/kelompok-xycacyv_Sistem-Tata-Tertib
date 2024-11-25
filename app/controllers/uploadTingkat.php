<?php
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

    $response = [
        'status' => 'error',
        'message' => 'process failed',
    ];

    $idPelanggaran = $_POST['idPelanggaranMhs'];
    $status = $_POST['status'];
    $idTigkat = isset($_POST['tingkatSanksiAdmin']) ? $_POST['tingkatSanksiAdmin'] : null;
    $nip = $id = $_SESSION['user']['id_users'];


    $result = $pelanggaranMahasiswaModel->uploadStatusAndTingkat($idPelanggaran, $status, $idTigkat,  $nip);

    echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
    exit;
}
?>