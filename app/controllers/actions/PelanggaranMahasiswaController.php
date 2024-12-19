<?php
require_once __DIR__ . "/../utils/uploadFile.php";
require_once __DIR__ . "/../../models/PelanggaranMahasiswaModel.php";
require_once __DIR__ . "/../../models/MahasiswaModel.php";
class PelanggaranMahasiswaController
{
    private $pelanggaranMahasiswaModel;
    private $mahasiswaModel;

    public function __construct()
    {
        $this->pelanggaranMahasiswaModel = new PelanggaranMahasiswaModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function filterDaftarPelaporan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $_SESSION['filter']['nim'] = isset($_GET['searchNim']) ? $_GET['searchNim'] : '';
            $_SESSION['filter']['tanggalAwal'] = isset($_GET['startTanggalPelaporan']) ? $_GET['startTanggalPelaporan'] : '';
            $_SESSION['filter']['tanggalAkhir'] = isset($_GET['endTanggalPelaporan']) ? $_GET['endTanggalPelaporan'] : '';
            $_SESSION['filter']['tingkat'] = isset($_GET['tingkatPelaporan']) ? $_GET['tingkatPelaporan'] : '';
            $_SESSION['filter']['status'] = isset($_GET['statusPelaporan']) ? $_GET['statusPelaporan'] : '';

            unset($_SESSION['allData']);

            echo json_encode(['status' => 'success']);
            exit;

        }
    }

    public function uploadSuratPernyataan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idPelanggaran = $_POST['idPelanggaranMhs'];

            $filePath = $this->uploadFile('suratPernyataan', $idPelanggaran);

            if ($filePath) {
                $result = $this->pelanggaranMahasiswaModel->uploadSuratPernyataan($idPelanggaran, $filePath);

                echo $result ? json_encode(['status' => 'success', 'message' => 'Upload success']) : json_encode(['status' => 'error', 'message' => 'Upload failed']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'File format not allowed or upload failed']);
            }
            exit;
        }
    }

    private function uploadFile($inputName, $idPelanggaran)
    {
        $targetDir = __DIR__ . "/../../../assets/pernyataan/";

        $fileName = basename($_FILES[$inputName]["name"]);
        $fileType = mime_content_type($_FILES[$inputName]["tmp_name"]);
        $fileSize = $_FILES[$inputName]["size"];
        $allowedTypes = ['application/pdf'];

        $maxFileSize = 5 * 1024 * 1024;

        if (!in_array($fileType, $allowedTypes)) {
            return false;
        }

        if ($fileSize > $maxFileSize) {
            return false;
        }

        $newFileName = $idPelanggaran . "." . pathinfo($fileName, PATHINFO_EXTENSION);
        $targetFilePath = $targetDir . $newFileName;

        if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFilePath)) {
            return $newFileName;
        }

        return false;
    }

    public function uploadPelanggaran()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            unset($_SESSION['allData']);

            $response = [
                'status' => 'error',
                'message' => 'Gagal: data tidak valid!',
            ];

            $nim = trim($_POST['nim']);
            $jenis = $_POST['jenisPelanggaran'];
            $catatan = trim($_POST['deskripsiLaporan']);
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

            $mahasiswa = $this->mahasiswaModel->getDataMahasiswa($nim);

            if (empty($mahasiswa)) {
                $message = "Gagal: NIM tidak valid!";
            } else if (!$sizeImages) {
                $message = "Gagal: Foto terlalu besar!";
            } else if (!$countImages) {
                $message = "Gagal: Jumlah maksimal foto 10!";
            } else if ($jenis == $invalidListPelanggaran) {
                $message = "Gagal: Pelanggaran tidak valid!";
            } else if ($mahasiswa) {
                if ($mahasiswa['status'] != 'aktif') {
                    $message = "Gagal: NIM tidak valid!";
                    $status = false;
                }
            }

            if ($mahasiswa && $sizeImages && $countImages && $status && $jenis != $invalidListPelanggaran) {
                $idPelanggaranMhs = $this->pelanggaranMahasiswaModel->uploadPelanggaran(
                    $nim,
                    $tanggal,
                    $catatan,
                    $pelapor,
                    $jenis,
                    $isEmptyImg
                );

                if ($idPelanggaranMhs) {

                    $files = uploadImage($idPelanggaranMhs);
                    $result = $this->pelanggaranMahasiswaModel->uploadImages($files, $idPelanggaranMhs['id_pelanggaran_mhs']);

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

    public function updatePelanggaran()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $idPelanggaran = $_POST['idPelanggaranMhs'];
            $catatan = trim($_POST['catatan']);
            $status = $_POST['status'];
            $idTigkat = isset($_POST['tingkatSanksiAdmin']) ? $_POST['tingkatSanksiAdmin'] : null;
            $nip = $_SESSION['user']['id_users'];
            $tanggal = date('Y-m-d');

            $result = $this->pelanggaranMahasiswaModel->uploadStatusAndTingkat($idPelanggaran, $catatan, $status, $idTigkat, $nip, $tanggal);

            echo $result == "berhasil" ?
            json_encode(['status' => 'success', 'message' => 'upload success'])
            :
            json_encode(['status' => 'error', 'message' => $result]);
            exit;

        }
    }
}
