<?php
require_once __DIR__ . "/../models/ListPelanggaran.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isLogin()) {
    $listPelanggaranModel = new ListPelanggaran();

    $response = [
        'status' => 'error',
        'message' => 'data not valid',
    ];

    $id = $_GET['id'];

    // $result = $tingkatPelanggaranModel->getSanksiByTingkat($tingkat);
    $result = $listPelanggaranModel->getListPelanggaranById($id);

    echo $result ? json_encode(['status' => 'success', 'data' => $result]) : json_encode($response);
    exit;
}
?>