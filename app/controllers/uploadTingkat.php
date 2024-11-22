<?php
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

    $response = [
        'status' => 'error',
        'message' => 'Email or Password is incorrect!',
    ];

    $idPelanggaran = $_POST[''];
    $status = $_POST['status'];
    $idTigkat = $_POST['tingkatPelanggaran'];
    $nip = $id = $_SESSION['user']['id_users'];


    $result = $pelanggaranMahasiswaModel->uploadStatusAndTingkat($idPelanggaran, $status, $idTigkat,  $nip);

    echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
    exit;
}
?>