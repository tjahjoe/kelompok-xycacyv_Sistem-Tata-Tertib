<?php
require_once __DIR__ . "/../models/ListPelanggaran.php";
require_once __DIR__ . "/../models/Mahasiswa.php";
require_once __DIR__ . "/../models/Dosen.php";
require_once __DIR__ . "/../models/Admin.php";
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/../../assets/utils/setData.php";
require_once __DIR__ . "/check.php";

function ListPelanggaran()
{
    $listPelanggaranModel = new ListPelanggaran();
    $listPelanggaran = $listPelanggaranModel->getAllListPelanggaran();
    return $listPelanggaran;
}


//pengaturan akun
function dataUser()
{
    if (isLogin()) {
        $id = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];
        if ($role == 'mahasiswa') {
            $mahasiswaModel = new Mahasiswa();
            $dataMahasiwa = $mahasiswaModel->getDataMahasiswa($id);
            $dataMahasiwa = $dataMahasiwa ? setFirstnameAndLastname($dataMahasiwa) : false; 
            return $dataMahasiwa;
        } else if (in_array($role, ['dpa', 'sekjur', 'dosen', 'kps'])) {
            $dosenModel = new Dosen();
            $dataDosen = $dosenModel->getDataDosen($id);
            $dataDosen = $dataDosen ? setFirstnameAndLastname($dataDosen) : false; 
            return $dataDosen;
        } else if ($role == 'admin') {
            $adminModel = new Admin();
            $dataAdmin = $adminModel->getDataAdmin($id);
            $dataAdmin = $dataAdmin ? setFirstnameAndLastname($dataAdmin) : false; 
            return $dataAdmin;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


//riwayat pelanggaran
//daftar pelaporan
function dataPelanggaran()
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

        $id = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];

        if ($role == 'mahasiswa') {
            $dataPelanggaran = $pelanggaranMahasiswaModel->getDataPelanggaranByPelanggar($id);
            return $dataPelanggaran;
        } else if ($role == 'dpa') {
            $dataPelanggaran = $pelanggaranMahasiswaModel->getDataPelanggaranByDpa($id);
            return $dataPelanggaran;
        } else if (in_array($role, ['sekjur', 'kps', 'admin'])) {
            $dataPelanggaran = $pelanggaranMahasiswaModel->getAllDataPelanggaran();
            return $dataPelanggaran;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

//riwayat pelaporan
function dataPelapor()
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

        $id = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];

        if (in_array($role, ['dpa', 'sekjur', 'kps', 'admin', 'dosen'])) {
            $dataLaporan = $pelanggaranMahasiswaModel->getDataPelanggaranByPelapor($id);
            return $dataLaporan;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

//detail pelaporan
function detailPelaporan($id, $condition = false)
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

        $idUser = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];

        if ($role == 'dpa') {
            $detail = $pelanggaranMahasiswaModel->getDetailDaftarPelanggaran($id, idUser: $idUser, isDpa: true, condition: $condition, role: $role);
            $detail = $detail ? setArrayForImageName($detail) : false;
            return $detail;
        } else if (in_array($role, ['sekjur', 'kps', 'admin', 'dosen'])) {
            $detail = $pelanggaranMahasiswaModel->getDetailDaftarPelanggaran($id, idUser: $idUser, condition: $condition, role: $role);
            $detail = $detail ? setArrayForImageName($detail) : false;
            return $detail;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


//detail pelanggaran
function detailPelanggaran($id)
{
    if (isLogin()) {

        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

        $nim = $_SESSION['user']['id_users'];

        $detail = $pelanggaranMahasiswaModel->getDetailDataPelanggaran($id, $nim);
        $detail = $detail ? setArrayForImageName($detail) : false;
        return $detail;
    } else {
        return false;
    }
}

function tingkatPelanggaran($id)
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();
        // tingkat by sanksi
        $tingkat = $pelanggaranMahasiswaModel->getTingkatPelanggaranForDetailDaftarPelanggaran($id);
        $tingkat = $tingkat ? setTingkatPelanggaranToSanksi($tingkat) : false;
        return $tingkat;
    }
}

function dataPelanggaranPagination($num)
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

        if ($num != '') {
            $num = $num - 1 >= 0 ? ($num - 1) * 10 : 0;
        }

        $nim = isset($_SESSION['filter']['nim']) ? $_SESSION['filter']['nim'] : '';
        $tanggalAwal = isset($_SESSION['filter']['tanggalAwal']) ? $_SESSION['filter']['tanggalAwal'] : '';
        $tanggalAkhir = isset($_SESSION['filter']['tanggalAkhir']) ? $_SESSION['filter']['tanggalAkhir'] : '';
        $tingkat = isset($_SESSION['filter']['tingkat']) ? $_SESSION['filter']['tingkat'] : '';
        $status = isset($_SESSION['filter']['status']) ? $_SESSION['filter']['status'] : '';

        $id = isset($_SESSION['user']['id_users']) ? $_SESSION['user']['id_users'] : '';
        $role = isset($_SESSION['user']['role']) ? $_SESSION['user']['role'] : '';

        if ($role == 'dpa') {
            $results = $pelanggaranMahasiswaModel->getDaftarPelaporanByFilter(
                $nim,
                $tanggalAwal,
                $tanggalAkhir,
                $tingkat,
                $status,
                $num,
                $id,
                true
            );  
            $results = $results ? changeNameValue($results) : false;  
            return $results;
        } else if (in_array($role, ['sekjur', 'kps', 'admin'])) {
            $results = $pelanggaranMahasiswaModel->getDaftarPelaporanByFilter(
                $nim,
                $tanggalAwal,
                $tanggalAkhir,
                $tingkat,
                $status,
                $num
            );
            $results = $results ? changeNameValue($results) : false;  
            return $results;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>