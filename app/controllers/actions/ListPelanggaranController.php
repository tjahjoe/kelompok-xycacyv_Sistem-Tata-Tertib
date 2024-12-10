<?php
require_once __DIR__ . "/../../models/ListPelanggaranModel.php";
class ListPelanggaranController
{
    private $listPelanggaranModel;

    public function __construct()
    {
        $this->listPelanggaranModel = new ListPelanggaranModel();
    }

    public function filterListPelanggaranByTingkat(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $response = [
                'status' => 'error',
                'message' => 'No data found for the selected tingkat pelanggaran.',
            ];

            $tingkatPelanggaran = isset($_GET['tingkatPelanggaran']) ? $_GET['tingkatPelanggaran'] : '';

            if ($tingkatPelanggaran == '') {
                $results = $this->listPelanggaranModel->getAllListPelanggaran();
            } else {
                $results = $this->listPelanggaranModel->getListPelanggaranByTingkat($tingkatPelanggaran);
            }

            echo $results ? json_encode(['status' => 'success', 'data' => $results]) : json_encode($response);
            exit;
        }
    }

    public function filterListPelanggaranById(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        
            $response = [
                'status' => 'error',
                'message' => 'data not valid',
            ];
        
            $id = isset($_GET['id']) ? $_GET['id'] : '';
        
            $result = $this->listPelanggaranModel->getListPelanggaranById($id);
        
            echo $result ? json_encode(['status' => 'success', 'data' => $result]) : json_encode($response);
            exit;
        }
    }

    public function uploadListPelanggaran()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $tingkat = $_POST['tingkatPelanggaran'];
            $nama = trim($_POST['namaPelanggaran']);

            $result = false;
            $message = "";

            if (!$nama) {
                $message = "Gagal: Nama pelanggaran harus diisi!";
            } else if (!$tingkat) {
                $message = "Gagal: Tingkat pelanggaran harus diisi!";
            }

            if ($nama && $tingkat) {
                $result = $this->listPelanggaranModel->uploadListPelanggaran($nama, $tingkat);

                echo $result ?
                    json_encode(['status' => 'success', 'message' => 'upload success'])
                    :
                    json_encode(['status' => 'error', 'message' => 'Gagal: Nama pelanggaran tidak boleh sama!']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => $message]);
                exit;
            }
        }
    }

    public function updateListPelanggaran()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['idPelanggaran'];
            $nama = trim($_POST['namaPelanggaran']);
            $tingkat = $_POST['tingkatPelanggaran'];

            $result = false;

            if ($nama) {
                $result = $this->listPelanggaranModel->updateListPelanggaran($id, $nama, $tingkat);

                echo $result ?
                    json_encode(['status' => 'success', 'message' => 'upload success'])
                    :
                    json_encode(['status' => 'error', 'message' => 'Gagal: Nama pelanggaran tidak boleh sama!']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal: Nama pelanggaran harus diisi!']);
                exit;
            }
        }
    }
    public function deleteListPelanggaran()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $response = [
                'status' => 'error',
                'message' => 'process failed!',
            ];

            $id = $_POST['id'];

            $result = $this->listPelanggaranModel->deleteListPelanggaran($id);

            echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
            exit;
        }
    }
}
?>