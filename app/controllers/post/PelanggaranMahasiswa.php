<?php
require_once __DIR__ . "/../../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/../../models/Mahasiswa.php";
// require_once __DIR__ . "/../../../assets/utils/setData.php";
require_once __DIR__ . "/../utils/uploadFile.php";
function uploadPelanggaran(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();
        $mahasiswaModel = new Mahasiswa();
    
        unset($_SESSION['allData']);
    
        $response = [
            'status' => 'error',
            'message' => 'data not valid',
        ];
    
        $nim = $_POST['nim'];
        $jenis = $_POST['jenisPelanggaran'];
        $catatan = $_POST['deskripsiLaporan'];
        $tanggal = date('Y-m-d');
        $pelapor = $_SESSION['user']['id_users'];
        $isEmptyImg = empty($_FILES['lampiran']['name'][0]);
    
        $condition = true;
        $message = '';
        $status = true;
        $invalidListPelanggaran = "Data is not No data found for the selected tingkat pelanggaran.";
    
        if (!$isEmptyImg) {
            $maxsize = 3 * 1024 * 1024;
            $condition = array_sum($_FILES['lampiran']['size']) <= $maxsize && count($_FILES['lampiran']['name']) <= 10 ? true : false;
        }
    
        $mahasiswa = $mahasiswaModel->getDataMahasiswa($nim);
    
        if ($mahasiswa) {
            if ($mahasiswa['status'] != 'aktif') {
                $message = "nim not valid";
                $status = false;
            }
        } else if (empty($mahasiswa)) {
            $message = "nim not valid";
        } else if (!$condition) {
            $message = "image size is too large";
        } else if ($jenis == $invalidListPelanggaran) {
            $message = "data not valid";
        }
    
        if ($mahasiswa && $condition && $status && $jenis != $invalidListPelanggaran) {
            $idPelanggaranMhs = $pelanggaranMahasiswaModel->uploadPelanggaran(
                $nim,
                $tanggal,
                $catatan,
                $pelapor,
                $jenis,
                $isEmptyImg
            );
    
            if ($idPelanggaranMhs) {
    
                $files = uploadImage($idPelanggaranMhs);
                $result = $pelanggaranMahasiswaModel->uploadImages($files, $idPelanggaranMhs['id_pelanggaran_mhs']);
    
                // echo json_encode($result);
                echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
                exit;
            } else {
                echo json_encode(['status' => 'success', 'message' => $jenis]);
                exit;
            }
        } else {
            $response['message'] = $message;
            echo json_encode($response);
            exit;
        }
    }
}

function updatePelanggaran(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();
    
        $response = [
            'status' => 'error',
            'message' => 'process failed',
        ];

        $idPelanggaran = $_POST['idPelanggaranMhs'];
        $catatan = $_POST['catatan'];
        $status = $_POST['status'];
        $idTigkat = isset($_POST['tingkatSanksiAdmin']) ? $_POST['tingkatSanksiAdmin'] : null;
        $nip = $id = $_SESSION['user']['id_users'];
        $tanggal = date('Y-m-d');
    
    
        $result = $pelanggaranMahasiswaModel->uploadStatusAndTingkat($idPelanggaran, $catatan, $status, $idTigkat,  $nip, $tanggal);
    
        echo $result ? json_encode(['status' => 'success', 'message' => 'upload success']) : json_encode($response);
        exit;
    }
}
?>