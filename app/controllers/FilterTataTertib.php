<?php
require_once __DIR__ . "/../models/ListPelanggaran.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tingkatPelanggaran'])) {
    $tingkatPelanggaran = $_POST['tingkatPelanggaran'];
    
    $listPelanggaranModel = new ListPelanggaran();
    if($tingkatPelanggaran !== ''){
      $result = $listPelanggaranModel->getListPelanggaranByTingkat(
        $tingkatPelanggaran
      );
    }else{
      $result = $listPelanggaranModel->getAllListPelanggaran();
    }

    // Check if data is found
    if (!empty($result)) {
        echo json_encode(['status' => 'success', 'data' => $result]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data found for the selected tingkat pelanggaran.']);
    }
}
?>
