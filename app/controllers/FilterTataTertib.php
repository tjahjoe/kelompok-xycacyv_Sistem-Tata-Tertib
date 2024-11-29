<?php
require_once __DIR__ . "/../models/ListPelanggaran.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {//menggunakan get

    $listPelanggaranModel = new ListPelanggaran();

    $response = [
        'status' => 'error',
        'message' => 'No data found for the selected tingkat pelanggaran.',
    ];

    $tingkatPelanggaran = $_POST['tingkatPelanggaran'];

    if ($tingkatPelanggaran == '') {
        $results = $listPelanggaranModel->getAllListPelanggaran();
    } else {
        $results = $listPelanggaranModel->getListPelanggaranByTingkat($tingkatPelanggaran);
    }
    
    echo $results ? json_encode(['status' => 'success', 'data' => $results]) : json_encode($response); 
    exit;
}
?>