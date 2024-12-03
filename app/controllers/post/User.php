<?php
session_start();
require_once __DIR__ . "/../../models/User.php";
require_once __DIR__ . "/../../models/Admin.php";
require_once __DIR__ . "/../../models/Dosen.php";
require_once __DIR__ . "/../../models/Mahasiswa.php";
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
    
        $nama = $_POST['nama'];
        $notelp = $_POST['notelp'];
        $id = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];

        $message = "";
        if (!$nama) {
            $message = "Gagal: Nama harus diisi";
        } else if (!$notelp) {
            $message = "Gagal: Nomor telepon harus diisi";
        }

        if ($nama && $notelp) {
            if ($role == 'mahasiswa') {
                $result = $mahasiswaModel->changeData($nama, $id, $notelp);
            } else if ($role == 'admin') {
                $result = $adminModel->changeData($nama, $id, $notelp);
            } else if (in_array($role, ['sekjur', 'kps', 'dpa', 'dosen'])) {
                $result = $dosenModel->changeData($nama, $id, $notelp);
            }
        
            echo $result ? 
            json_encode(['status' => 'success', 'message' => 'update success']) 
            : 
            json_encode(['status' => 'error', 'message' => 'Gagal: Nomor telepon tidak valid']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => $message]);
            exit;
        }
    }
}

function updatePhotoProfil(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new User();

        $id = $_SESSION['user']['id_users'];
        $sizeImage = $_FILES['photo']['size'];
        $maxsize = 3 * 1024 * 1024;

        $checkSize = $sizeImage <= $maxsize ? true : false;
    
        if ($checkSize) {
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
        
            $userModel->changePhoto($id, $fileName);
        
            echo json_encode(['status' => 'success', 'message' => 'update success']);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal: Batas maksimal ukuran foto profil 3MB']);
            exit;
        }
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
    
        $result = $userModel->changePhoto($id, $fileName);
    
        echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
        exit;
    }
}
?>