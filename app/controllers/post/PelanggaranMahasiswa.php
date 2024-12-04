<?php
require_once __DIR__ . "/../../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/../../models/Mahasiswa.php";
require_once __DIR__ . "/../utils/uploadFile.php";
function uploadPelanggaran()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();
        $mahasiswaModel = new Mahasiswa();

        unset($_SESSION['allData']);

        $response = [
            'status' => 'error',
            'message' => 'Gagal: data tidak valid',
        ];

        $nim = $_POST['nim'];
        $jenis = $_POST['jenisPelanggaran'];
        $catatan = $_POST['deskripsiLaporan'];
        $tanggal = date('Y-m-d');
        $pelapor = $_SESSION['user']['id_users'];
        $isEmptyImg = empty($_FILES['lampiran']['name'][0]);

        $sizeImages = true;
        $countImages = true;
        $message = '';
        $status = true;
        $invalidListPelanggaran = "No data found for the selected tingkat pelanggaran.";

        if (!$isEmptyImg) {
            $maxsize = 3 * 1024 * 1024;
            $sizeImages = array_sum($_FILES['lampiran']['size']) <= $maxsize ? true : false;
            $countImages = count($_FILES['lampiran']['name']) <= 10 ? true : false;
        }

        $mahasiswa = $mahasiswaModel->getDataMahasiswa($nim);

        if (empty($mahasiswa)) {
            $message = "Gagal: NIM tidak valid";
        } else if (!$sizeImages) {
            $message = "Gagal: Foto terlalu besar";
        } else if (!$countImages) {
            $message = "Gagal: Jumlah maksimal foto 10";
        } else if ($jenis == $invalidListPelanggaran) {
            $message = "Gagal: Pelanggaran tidak valid";
        } else if ($mahasiswa) {
            if ($mahasiswa['status'] != 'aktif') {
                $message = "Gagal: NIM tidak valid";
                $status = false;
            }
        }

        if ($mahasiswa && $sizeImages && $countImages && $status && $jenis != $invalidListPelanggaran) {
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

function updatePelanggaran()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

        $idPelanggaran = $_POST['idPelanggaranMhs'];
        $catatan = $_POST['catatan'];
        $status = $_POST['status'];
        $idTigkat = isset($_POST['tingkatSanksiAdmin']) ? $_POST['tingkatSanksiAdmin'] : null;
        $nip = $_SESSION['user']['id_users'];
        $tanggal = date('Y-m-d');
        // $tingkatPelanggaran = $_POST['tingkatPelanggaranAdmin'];
        // $role = $_SESSION['user']['role'];

        $condition = true;
        // if ($role == "dpa" && !in_array($tingkatPelanggaran, ['V', 'IV', "III"])) {
        //     $condition = false;
        // }

        if ($condition) {
            $result = $pelanggaranMahasiswaModel->uploadStatusAndTingkat($idPelanggaran, $catatan, $status, $idTigkat, $nip, $tanggal);

            echo $result == "berhasil" ?
                json_encode(['status' => 'success', 'message' => 'upload success'])
                :
                json_encode(['status' => 'error', 'message' => $result]);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal: DPA tidak bisa memproses pelanggaran diatas tingkat III']);
            exit;
        }
    }
}
?>