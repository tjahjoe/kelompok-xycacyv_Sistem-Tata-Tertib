<?php
require_once __DIR__ . "/../../models/ListPelanggaran.php";

function filterListPelanggaranByTingkat(): void{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $listPelanggaranModel = new ListPelanggaran();
    
        $response = [
            'status' => 'error',
            'message' => 'No data found for the selected tingkat pelanggaran.',
        ];
    
        $tingkatPelanggaran = isset($_GET['tingkatPelanggaran']) ? $_GET['tingkatPelanggaran'] : '';
    
        if ($tingkatPelanggaran == '') {
            $results = $listPelanggaranModel->getAllListPelanggaran();
        } else {
            $results = $listPelanggaranModel->getListPelanggaranByTingkat($tingkatPelanggaran);
        }
        
        echo $results ? json_encode(['status' => 'success', 'data' => $results]) : json_encode($response); 
        exit;
    }
}

function filterListPelanggaranById(){
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $listPelanggaranModel = new ListPelanggaran();
    
        $response = [
            'status' => 'error',
            'message' => 'data not valid',
        ];
    
        $id = isset($_GET['id']) ? $_GET['id'] : '';
    
        $result = $listPelanggaranModel->getListPelanggaranById($id);
    
        echo $result ? json_encode(['status' => 'success', 'data' => $result]) : json_encode($response);
        exit;
    }
}
?>