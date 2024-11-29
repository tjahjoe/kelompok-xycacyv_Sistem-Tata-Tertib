<?php
require_once __DIR__ . "/../models/ListPelanggaran.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $listPelanggaranModel = new ListPelanggaran();

    $response = [
        'status' => 'error',
        'message' => 'process failed',
    ];

    $tingkat = $_POST['tingkat'];
    $nama = $_POST['nama'];

    $result = $listPelanggaranModel->uploadListPelanggaran($nama, $tingkat);

    echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
    exit;
}
?>