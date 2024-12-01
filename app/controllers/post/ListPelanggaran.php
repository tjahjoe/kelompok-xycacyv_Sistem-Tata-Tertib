<?php
require_once __DIR__ . "/../../models/ListPelanggaran.php";

function uploadListPelanggaran()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $listPelanggaranModel = new ListPelanggaran();

        $response = [
            'status' => 'error',
            'message' => 'process failed',
        ];

        $tingkat = $_POST['tingkatPelanggaran'];
        $nama = $_POST['namaPelanggaran'];

        $result = false;

        if ($nama && $tingkat) {
            $result = $listPelanggaranModel->uploadListPelanggaran($nama, $tingkat);  
        }

        echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
        exit;
    }
}

function updateListPelanggaran()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $listPelanggaranModel = new ListPelanggaran();

        $response = [
            'status' => 'error',
            'message' => 'process failed',
        ];


        $id = $_POST['idPelanggaran'];
        $nama = $_POST['namaPelanggaran'];
        $tingkat = $_POST['tingkatPelanggaran'];

        $result = false;

        if ($nama) {
            $result = $listPelanggaranModel->updateListPelanggaran($id, $nama, $tingkat);   
        }

        echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
        exit;
    }
}
function deleteListPelanggaran()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $listPelanggaranModel = new ListPelanggaran();

        $response = [
            'status' => 'error',
            'message' => 'process failed',
        ];

        $id = $_POST['id'];

        $result = $listPelanggaranModel->deleteListPelanggaran($id);

        echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
        exit;
    }
}
?>