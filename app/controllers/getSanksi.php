<?php
require_once __DIR__ . "/../models/TingkatPelanggaran.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {//menggunakan get
    $tingkatPelanggaranModel = new TingkatPelanggaran();

    $response = [
        'status' => 'error',
        'message' => 'data not valid',
    ];

    $tingkat = $_POST['tingkatSanksi'];

    $result = $tingkatPelanggaranModel->getSanksiByTingkat($tingkat);

    echo $result ? json_encode(['status' => 'success', 'data' => $result]) : json_encode($response);
    exit;
}
?>