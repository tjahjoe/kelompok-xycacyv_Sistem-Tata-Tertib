<?php
require_once __DIR__ . "/../../models/ListPelanggaran.php";

function uploadListPelanggaran()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $listPelanggaranModel = new ListPelanggaran();

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
            $result = $listPelanggaranModel->uploadListPelanggaran($nama, $tingkat);

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

function updateListPelanggaran()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $listPelanggaranModel = new ListPelanggaran();

        $id = $_POST['idPelanggaran'];
        $nama = trim($_POST['namaPelanggaran']);
        $tingkat = $_POST['tingkatPelanggaran'];

        $result = false;

        if ($nama) {
            $result = $listPelanggaranModel->updateListPelanggaran($id, $nama, $tingkat);

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
function deleteListPelanggaran()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $listPelanggaranModel = new ListPelanggaran();

        $response = [
            'status' => 'error',
            'message' => 'process failed!',
        ];

        $id = $_POST['id'];

        $result = $listPelanggaranModel->deleteListPelanggaran($id);

        echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
        exit;
    }
}
?>