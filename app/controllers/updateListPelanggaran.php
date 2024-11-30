<?php
require_once __DIR__ . "/../models/ListPelanggaran.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $listPelanggaranModel = new ListPelanggaran();

    $response = [
        'status' => 'error',
        'message' => 'process failed',
    ];

    $id = $_POST['idPelanggaran'];
    $tingkat = $_POST['tingkatPelanggaran'];
    $nama = $_POST['namaPelanggaran'];

    $result = $listPelanggaranModel->updateListPelanggaran($id,$nama, $tingkat);

    echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
    exit;
}
?>