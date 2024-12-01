<?php
session_start();
require_once __DIR__ . "/../../models/User.php";
require_once __DIR__ . "/../../models/Admin.php";
require_once __DIR__ . "/../../models/Dosen.php";
require_once __DIR__ . "/../../models/Mahasiswa.php";
// require_once __DIR__ . "/../../../assets/utils/setData.php";
require_once __DIR__ . "/../utils/uploadFile.php";
function login(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new User();
    
        $response = [
            'status' => 'error',
            'message' => 'Email or Password is incorrect!',
        ];
    
        $id = $_POST['idAnggota'];
        $password = $_POST['password'];
    
        $user = $userModel->login($id, $password);
    
        if ($user) {
            $_SESSION['user'] = $user;
            $response['status'] = 'success';
            $response['message'] = 'Login successful';
        }
    
        echo json_encode($response);
        exit;
    }
}

function updateDataUser(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    
        if ($role == 'mahasiswa') {
            $result = $mahasiswaModel->changeData($nama, $id, $notelp);
        } else if ($role == 'admin') {
            $result = $adminModel->changeData($nama, $id, $notelp);
        } else if (in_array($role, ['sekjur', 'kps', 'dpa', 'dosen'])) {
            $result = $dosenModel->changeData($nama, $id, $notelp);
        }
    
        echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
        exit;
    }
}

function updatePhotoProfil(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new User();
    
        $response = [
            'status' => 'error',
            'message' => 'process failed',
        ];
    
        $id = $_SESSION['user']['id_users'];
    
        $lastFileName = $userModel->checkPhotoName($id);
    
        if ($lastFileName) {
            if ($lastFileName['foto_diri'] != null) {
                $targetDirectory = "../../assets/uploads/photo/";
                if (file_exists($targetDirectory . $lastFileName['foto_diri'])) {
                    unlink($targetDirectory . $lastFileName['foto_diri']);
                }
            }
        }
    
        $fileName = changePhotoProfil($id);
    
        $result = $userModel->changeFoto($id, $fileName);
    
        echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
        exit;
    }
}

function deletePhotoProfil(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new User();
    
        $response = [
            'status' => 'error',
            'message' => 'process failed',
        ];
    
        $id = $_SESSION['user']['id_users'];
    
        $lastFileName = $userModel->checkPhotoName($id);
    
        if ($lastFileName) {
            if ($lastFileName['foto_diri'] != null) {
                $targetDirectory = "../../assets/uploads/photo/";
                if (file_exists($targetDirectory . $lastFileName['foto_diri'])) {
                    unlink($targetDirectory . $lastFileName['foto_diri']);
                }
            }
        }
    
        $fileName = null;
    
        $result = $userModel->changeFoto($id, $fileName);
    
        echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
        exit;
    }
}
?>