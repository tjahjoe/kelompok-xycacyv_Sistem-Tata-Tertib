<?php
require_once __DIR__ . "/../models/Admin.php";
require_once __DIR__ . "/../models/Dosen.php";
require_once __DIR__ . "/../models/Mahasiswa.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $adminModel = new Admin();
    $dosenModel = new Dosen();
    $mahasiswaModel = new Mahasiswa();

    $response = [
        'status' => 'error',
        'message' => 'process failed',
    ];

    $nama = $_POST['nama'];
    $notelp = $_POST['notelp'];
    $id = $_SESSION['user']['id_users'];
    $role = $_SESSION['user']['role'];

    // var_dump($nama);
    // var_dump($notelp);
    // var_dump($id);
    // var_dump($role);

    if ($role == 'mahasiswa') {
        $result = $mahasiswaModel->changeData($nama, $id, $notelp);
    } else if ($role == 'admin') {
        $result = $adminModel->changeData($nama, $id, $notelp);
    } else if (in_array($role, ['sekjur', 'kps', 'dpa', 'dosen'])) {
        $result = $dosenModel->changeData($nama, $id, $notelp);
    }


    // $result = $pelanggaranMahasiswaModel->uploadStatusAndTingkat($idPelanggaran, $status, $idTigkat,  $nip);

    echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
    exit;
}
?>