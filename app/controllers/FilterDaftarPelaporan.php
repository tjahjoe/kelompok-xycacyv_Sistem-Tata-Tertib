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

    $nim = $_SESSION['filter']['nim'] = $_POST['searchNim'];
    $tanggalAwal = $_SESSION['filter']['tanggalAwal'] = $_POST['startTanggalPelaporan'];
    $tanggalAkhir = $_SESSION['filter']['tanggalAkhir'] = $_POST['endTanggalPelaporan'];
    $tingkat = $_SESSION['filter']['tingkat'] = $_POST['tingkatPelaporan'];
    $status = $_SESSION['filter']['status'] = $_POST['statusPelaporan'];

    // $_SESSION['filter']['nim'] = $nim;
    // $_SESSION['filter']['tanggalAwal'] = $tanggalAwal;
    // $_SESSION['filter']['tanggalAkhir'] = $tanggalAkhir;
    // $_SESSION['filter']['tingkat'] = $tingkat;
    // $_SESSION['filter']['status'] = $status;

    $id = $_SESSION['user']['id_users'];
    $role = $_SESSION['user']['role'];

    // $results = $role == 'dpa' ? $pelanggaranMahasiswaModel->getDaftarPelaporanByFilter(
    //     $nim,
    //     $tanggalAwal,
    //     $tanggalAkhir,
    //     $tingkat,
    //     $status,
    //     null,
    //     $id,
    //     true
    // ) : $pelanggaranMahasiswaModel->getDaftarPelaporanByFilter(
    //     $nim,
    //     $tanggalAwal,
    //     $tanggalAkhir,
    //     $tingkat,
    //     $status,
    //     null
    // ) ;

    // if($results){
    //     foreach ($results as &$item) {
    //         $item['badge'] = Badge(strtolower($item['status']));
    //     }       

    //     echo json_encode(['status' => 'success', 'data' => $results]);
    //     exit;
    // }else{
    //     echo json_encode($response);
    //     exit;
    // }
    unset($_SESSION['allData']);

    echo json_encode(['status' => 'success']);
    exit;

    // echo $results ? json_encode(['status' => 'success', 'data' => $results]) : json_encode($response);

}
?>