<?php
require_once __DIR__ . "/../utils/uploadFile.php";
require_once __DIR__ . "/../utils/check.php";
require_once __DIR__ . "/../../models/UsersModel.php";
require_once __DIR__ . "/../../models/AdminModel.php";
require_once __DIR__ . "/../../models/DosenModel.php";
require_once __DIR__ . "/../../models/MahasiswaModel.php";

class UsersController
{
    private $userModel;
    private $adminModel;
    private $dosenModel;
    private $mahasiswaModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->adminModel = new AdminModel();
        $this->dosenModel = new DosenModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function filterUserById()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $response = [
                'status' => 'error',
                'message' => 'data not valid',
            ];

            $id = isset($_GET['searchNim']) ? $_GET['searchNim'] : '';
            $idUser = $_SESSION['user']['id_users'];

            $result = $this->userModel->getDataUsersByFilter($id, $idUser);

            echo $result ? json_encode(['status' => 'success', 'data' => $result]) : json_encode($response);
            exit;
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $response = [
                'status' => 'error',
                'message' => 'Gagal: Email atau kata sandi salah!',
            ];

            $id = $_POST['idAnggota'];
            $password = $_POST['password'];

            $user =$this->userModel->login($id, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                $response['status'] = 'success';
                $response['message'] = 'Login successful';
            }

            echo json_encode($response);
            exit;
        }
    }

    public function logoutHandler()
    {
        logout();
        header("Location: ../../../public/login.php");
        exit;
    }

    public function uploadUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            $email = $_POST['email'];
            $notelp = $_POST['notelp'];
            $nama = $_POST['nama'];
            $role = $_POST['role'];

            $result = '';

            if ($role == 'mahasiswa') {
                $namaOrtu = $_POST['namaOrtu'];
                $notelpOrtu = $_POST['notelpOrtu'];
                $dpa = $_POST['dpa'] ?? '';
                
                if ($dpa) {
                    $result = $this->userModel->uploadMahasiswa(
                        $id,
                        $notelp,
                        $nama,
                        $email,
                        $namaOrtu,
                        $notelpOrtu,
                        $dpa,
                        $role
                    );
                } else {
                    echo json_encode(['status' => 'error', 'message' => "Gagal: Pilih DPA!"]);
                    exit;
                }
            } else if ($role == 'admin') {
                $result = $this->userModel->uploadAdmin($id, $notelp, $nama, $email, $role);
            } else if (in_array($role, ['sekjur', 'kps', 'dpa', 'dosen'])) {
                $result = $this->userModel->uploadDosen($id, $notelp, $nama, $email, $role);
            }

            echo $result == 'berhasil' ?
                json_encode(['status' => 'success', 'message' => 'upload success'])
                :
                json_encode(['status' => 'error', 'message' => $result]);
            exit;
        }
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            $email = $_POST['email'];
            $notelp = $_POST['notelp'];
            $nama = $_POST['nama'];
            $roleAwal = $_POST['roleAwal'] ?? '';
            $roleAkhir = $_POST['roleAkhir'] ?? '';
            $role = $_POST['role'] ?? '';
            $status = $_POST['status'];

            $result = '';

            if ($role == 'mahasiswa' && $role == 'mahasiswa') {
                $namaOrtu = $_POST['namaOrtu'];
                $notelpOrtu = $_POST['notelpOrtu'];
                $dpa = $_POST['dpa'] ?? '';
                if ($dpa) {
                    $result = $this->userModel->updateMahasiswa(
                        $id,
                        $notelp,
                        $nama,
                        $email,
                        $namaOrtu,
                        $notelpOrtu,
                        $status,
                        $dpa
                    );
                } else {
                    echo json_encode(['status' => 'error', 'message' => "Gagal: Pilih DPA!"]);
                    exit;
                }
            } else if ($roleAwal == 'admin' && $roleAkhir == 'admin') {
                $result = $this->userModel->updateAdmin($id, $email, $notelp, $status, $nama, $roleAkhir);
            } else if (in_array($roleAwal, ['sekjur', 'kps', 'dpa', 'dosen']) && in_array($roleAkhir, ['sekjur', 'kps', 'dpa', 'dosen'])) {
                $result = $this->userModel->updateDosen(
                    $id,
                    $email,
                    $notelp,
                    $status,
                    $nama,
                    $roleAwal,
                    $roleAkhir
                );
            } else if (in_array($roleAwal, ['sekjur', 'kps', 'dpa', 'dosen']) && $roleAkhir == 'admin') {
                $result = $this->userModel->updateDosenToAdmin($id, $email, $notelp, $status, $nama, $roleAkhir);
            } else if ($roleAwal == 'admin' && in_array($roleAkhir, ['sekjur', 'kps', 'dpa', 'dosen'])) {
                $result = $this->userModel->updateAdminToDosen($id, $email, $notelp, $status, $nama, $roleAkhir);
            }

            echo $result == 'berhasil' ?
                json_encode(['status' => 'success', 'message' => 'upload success'])
                :
                json_encode(['status' => 'error', 'message' => $result]);
            exit;

        }
    }

    public function updateDataUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
                    $result = $this->mahasiswaModel->changeData($nama, $id, $notelp);
                } else if ($role == 'admin') {
                    $result = $this->adminModel->changeData($nama, $id, $notelp);
                } else if (in_array($role, ['sekjur', 'kps', 'dpa', 'dosen'])) {
                    $result = $this->dosenModel->changeData($nama, $id, $notelp);
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

    public function updatePhotoProfil()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_SESSION['user']['id_users'];
            $sizeImage = $_FILES['photo']['size'];
            $maxsize = 3 * 1024 * 1024;

            $checkSize = $sizeImage <= $maxsize ? true : false;

            if ($checkSize) {
                $lastFileName = $this->userModel->checkPhotoName($id);

                if ($lastFileName) {
                    if ($lastFileName['foto_diri'] != null) {
                        $targetDirectory = "../../assets/uploads/photo/";
                        if (file_exists($targetDirectory . $lastFileName['foto_diri'])) {
                            unlink($targetDirectory . $lastFileName['foto_diri']);
                        }
                    }
                }

                $fileName = changePhotoProfil($id);

                $this->userModel->changePhoto($id, $fileName);

                echo json_encode(['status' => 'success', 'message' => 'update success']);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal: Batas maksimal ukuran foto profil 3MB']);
                exit;
            }
        }
    }

    public function deletePhotoProfil()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $response = [
                'status' => 'error',
                'message' => 'process failed',
            ];

            $id = $_POST['id'];

            $lastFileName = $this->userModel->checkPhotoName($id);

            if ($lastFileName) {
                if ($lastFileName['foto_diri'] != null) {
                    $targetDirectory = "../../assets/uploads/photo/";
                    if (file_exists($targetDirectory . $lastFileName['foto_diri'])) {
                        unlink($targetDirectory . $lastFileName['foto_diri']);
                    }
                }
            }

            $fileName = null;

            $result = $this->userModel->changePhoto($id, $fileName);

            echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
            exit;
        }
    }
}
?>