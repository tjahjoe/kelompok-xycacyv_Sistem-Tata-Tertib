<?php
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

    $response = [
        'status' => 'error',
        'message' => 'No data found for the selected tingkat pelanggaran.',
    ];

    $nim = $_POST['searchNim'];
    $tanggalAwal = $_POST['startTanggalPelaporan'];
    $tanggalAkhir = $_POST['endTanggalPelaporan'];
    $tingkat = $_POST['tingkatPelaporan'];
    $status = $_POST['statusPelaporan'];

    $results = $pelanggaranMahasiswaModel->getDaftarPelaporan(
        $nim,
        $tanggalAwal,
        $tanggalAkhir,
        $tingkat,
        $status
    );

    echo $results ? json_encode(['status' => 'success', 'data' => $results]) : json_encode($response);
    exit;

}
?>