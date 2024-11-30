<?php

require_once __DIR__ . "/../../models/TingkatPelanggaran.php";
header('Content-Type: application/json');

function filterSanksiByTingkat(){
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tingkatPelanggaranModel = new TingkatPelanggaran();
    
        $response = [
            'status' => 'error',
            'message' => 'data not valid',
        ];
    
        $tingkat = isset($_GET['tingkatSanksi']) ? $_GET['tingkatSanksi'] : '';
    
        $result = $tingkatPelanggaranModel->getSanksiByTingkat($tingkat);
    
        echo $result ? json_encode(['status' => 'success', 'data' => $result]) : json_encode($response);
        exit;
    }
}
?>