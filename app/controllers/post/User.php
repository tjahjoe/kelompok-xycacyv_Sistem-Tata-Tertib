<?php
require_once __DIR__ . "/../../models/User.php";
require_once __DIR__ . "/../../models/Admin.php";
require_once __DIR__ . "/../../models/Dosen.php";
require_once __DIR__ . "/../../models/Mahasiswa.php";
require_once __DIR__ . "/../utils/uploadFile.php";
require_once __DIR__ . "/../utils/check.php";
function login()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new User();

        $response = [
            'status' => 'error',
            'message' => 'Gagal: Email atau kata sandi salah!',
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

function logoutHandler()
{
    logout();
    header("Location: ../../../public/login.php");
    exit;
}

function uploadUser()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new User();

        $id = $_POST['id'];
        $email = $_POST['email'];
        $notelp = $_POST['notelp'];
        $nama = $_POST['nama'];
        $role = $_POST['role'];

        $result = '';

        if ($role == 'mahasiswa') {
            $namaOrtu = $_POST['namaOrtu'];
            $notelpOrtu = $_POST['notelpOrtu'];
            $dpa = $_POST['dpa'];

            $result = $userModel->uploadMahasiswa(
                $id,
                $notelp,
                $nama,
                $email,
                $namaOrtu,
                $notelpOrtu,
                $dpa,
                $role
            );
        } else if ($role == 'admin') {
            $result = $userModel->uploadAdmin($id, $notelp, $nama, $email, $role);
        } else if (in_array($role, ['sekjur', 'kps', 'dpa', 'dosen'])) {
            $result = $userModel->uploadDosen($id, $notelp, $nama, $email, $role);
        }

        echo $result == 'berhasil' ?
            json_encode(['status' => 'success', 'message' => 'upload success'])
            :
            json_encode(['status' => 'error', 'message' => $result]);
    }
}

function updateUser()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userModel = new User();

        $id = $_POST['id'];
        $email = $_POST['email'];
        $notelp = $_POST['notelp'];
        $nama = $_POST['nama'];
        $roleAwal = isset($_POST['roleAwal']) ? $_POST['roleAwal'] : '';
        $roleAkhir = isset($_POST['roleAkhir']) ? $_POST['roleAwal'] : '';
        $role = isset($_POST['roleAkhir']) ? $_POST['roleAkhir'] : '' ;
        $status = $_POST['status'];

        $result = '';

        if ($role == 'mahasiswa' && $role == 'mahasiswa') {
            $namaOrtu = $_POST['namaOrtu'];
            $notelpOrtu = $_POST['notelpOrtu'];
            $dpa = $_POST['dpa'];

            $result = $userModel->updateMahasiswa(
                $id, 
                $notelp, 
                $nama, 
                $email, 
                $namaOrtu, 
                $notelpOrtu, 
                $status, 
                $dpa);
        } else if ($roleAwal == 'admin' && $roleAkhir == 'admin') {
            $result = $userModel->updateAdmin($id,$email, $notelp, $status, $nama, $roleAkhir);
        } else if (in_array($roleAwal, ['sekjur', 'kps', 'dpa', 'dosen']) && in_array($roleAkhir, ['sekjur', 'kps', 'dpa', 'dosen'])) {
            $result = $userModel->updateDosen($id,$email, $notelp, $status, $nama, $roleAkhir);
        } else if (in_array($roleAwal, ['sekjur', 'kps', 'dpa', 'dosen']) && $roleAkhir == 'admin') {
            $result = $userModel->updateDosenToAdmin($id,$email, $notelp, $status, $nama, $roleAkhir);
        } else if ($roleAwal == 'admin' && in_array($roleAkhir, ['sekjur', 'kps', 'dpa', 'dosen'])) {
            $result = $userModel->updateAdminToDosen($id,$email, $notelp, $status, $nama, $roleAkhir);
        }

        echo $result == 'berhasil' ?
            json_encode(['status' => 'success', 'message' => 'upload success'])
            :
            json_encode(['status' => 'error', 'message' => $result]);

    }
}

function DeleteUser()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    }
}

function updateDataUser()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adminModel = new Admin();
        $dosenModel = new Dosen();
        $mahasiswaModel = new Mahasiswa();

        $nama = trim($_POST['nama']);
        $id = $_SESSION['user']['id_users'];
        $notelp = trim($_POST['notelp']);
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

function updatePhotoProfil()
{
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

function deletePhotoProfil()
{
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