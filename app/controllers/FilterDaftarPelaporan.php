<?php
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/../views/components/badge.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

    $response = [
        'status' => 'error',
        'message' => 'No data found for the selected tingkat pelanggaran.',
    ];

    $_SESSION['filter']['nim'] = $_POST['searchNim'];
    $_SESSION['filter']['tanggalAwal'] = $_POST['startTanggalPelaporan'];
    $_SESSION['filter']['tanggalAkhir'] = $_POST['endTanggalPelaporan'];
    $_SESSION['filter']['tingkat'] = $_POST['tingkatPelaporan'];
    $_SESSION['filter']['status'] = $_POST['statusPelaporan'];

    unset($_SESSION['allData']);

    echo json_encode(['status' => 'success']);
    exit;

}
?>