<?php
require_once __DIR__ . "/../../models/TingkatPelanggaranModel.php";
class TingkatPelanggaranController {
    private $tingkatPelanggaranModel;

    public function __construct(){
        $this->tingkatPelanggaranModel = new TingkatPelanggaranModel();
    }

    public function filterSanksiByTingkat(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        
            $response = [
                'status' => 'error',
                'message' => 'data not valid',
            ];
        
            $tingkat = isset($_GET['tingkatSanksi']) ? $_GET['tingkatSanksi'] : '';
        
            $result = $this->tingkatPelanggaranModel->getSanksiByTingkat($tingkat);
        
            echo $result ? json_encode(['status' => 'success', 'data' => $result]) : json_encode($response);
            exit;
        }
    }
}
?>