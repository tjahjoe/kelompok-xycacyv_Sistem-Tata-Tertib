<?php
require_once __DIR__ . "/../models/ListPelanggaranModel.php";
require_once __DIR__ . "/../models/MahasiswaModel.php";
require_once __DIR__ . "/../models/DosenModel.php";
require_once __DIR__ . "/../models/AdminModel.php";
require_once __DIR__ . "/../models/UsersModel.php";
require_once __DIR__ . "/../models/PelanggaranMahasiswaModel.php";
require_once __DIR__ . "/utils/setData.php";
require_once __DIR__ . "/utils/check.php";

function ListPelanggaran()
{
    $listPelanggaranModel = new ListPelanggaranModel();
    $listPelanggaran = $listPelanggaranModel->getAllListPelanggaran();
    return $listPelanggaran;
}

function dataUsers(){
    if (isLogin()) {
        $id = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];

        if ($role == 'admin') {
            $userModel = new UsersModel();
            $datas = $userModel->getDataUsers($id);
            return $datas;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function dataUserByAdmin($id , $role){
    if (isLogin()) {
        if ($role == 'mahasiswa') {
            $mahasiswaModel = new MahasiswaModel();
            $dataMahasiwa = $mahasiswaModel->getDataMahasiswa($id);
            return $dataMahasiwa;
        } else if (in_array($role, ['dpa', 'sekjur', 'dosen', 'kps'])) {
            $dosenModel = new DosenModel();
            $dataDosen = $dosenModel->getDataDosen($id);
            return $dataDosen;
        } else if ($role == 'admin') {
            $adminModel = new AdminModel();
            $dataAdmin = $adminModel->getDataAdmin($id);
            return $dataAdmin;
        } else{
            return false;
        }
    } else {
        return false;
    }
}

//pengaturan akun
function dataUser()
{
    if (isLogin()) {
        $id = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];
        if ($role == 'mahasiswa') {
            $mahasiswaModel = new MahasiswaModel();
            $dataMahasiwa = $mahasiswaModel->getDataMahasiswa($id);
            $dataMahasiwa = $dataMahasiwa ? setFirstnameAndLastname($dataMahasiwa) : false;
            return $dataMahasiwa;
        } else if (in_array($role, ['dpa', 'sekjur', 'dosen', 'kps'])) {
            $dosenModel = new DosenModel();
            $dataDosen = $dosenModel->getDataDosen($id);
            $dataDosen = $dataDosen ? setFirstnameAndLastname($dataDosen) : false;
            return $dataDosen;
        } else if ($role == 'admin') {
            $adminModel = new AdminModel();
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

function dataDpa(){
    if (isLogin()) {
        $dosenModel = new DosenModel();
        $dataDpa = $dosenModel->getAllDpa();
        return $dataDpa;
    } else {
        return false;
    }
}

//riwayat pelanggaran
function dataPelanggaran()
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswaModel();

        $id = $_SESSION['user']['id_users'];
        $dataPelanggaran = $pelanggaranMahasiswaModel->getDataPelanggaranByPelanggar($id);
        return $dataPelanggaran;
        
    } else {
        return false;
    }
}

//riwayat pelaporan
function dataPelapor()
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswaModel();

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
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswaModel();

        $idUser = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];

        if ($role == 'dpa') {
            $detail = $pelanggaranMahasiswaModel->getDetailDaftarPelanggaran($id, idUser: $idUser, isDpa: true, condition: $condition);
            $detail = setArrayForImageName($detail);
            return $detail;
        } else if (in_array($role, ['sekjur', 'kps', 'admin', 'dosen'])) {
            $detail = $pelanggaranMahasiswaModel->getDetailDaftarPelanggaran($id, idUser: $idUser, condition: $condition);
            $detail = setArrayForImageName($detail);
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

        $pelanggaranMahasiswaModel = new PelanggaranMahasiswaModel();

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
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswaModel();
        // tingkat by sanksi
        $tingkat = $pelanggaranMahasiswaModel->getTingkatPelanggaranForDetailDaftarPelanggaran($id);
        $tingkat = $tingkat ? setTingkatPelanggaranToSanksi($tingkat) : false;
        return $tingkat;
    }
}

function dataPelanggaranPagination($num)
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswaModel();

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

function dataPelanggaranWithoutPagination()
{
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswaModel();

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
                null,
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
                null
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