<?php
require_once __DIR__ . "/../models/ListPelanggaran.php";
require_once __DIR__ . "/../models/Mahasiswa.php";
require_once __DIR__ . "/../models/Dosen.php";
require_once __DIR__ . "/../models/Admin.php";
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
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
            return $dataMahasiwa;
        } else if (in_array($role, ['dpa', 'sekjur', 'dosen', 'kps'])) {
            $dosenModel = new Dosen();
            $dataDosen = $dosenModel->getDataDosen($id);
            return $dataDosen;
        } else if ($role == 'admin') {
            $adminModel = new Admin();
            $dataAdmin = $adminModel->getDataAdmin($id);
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
            $detail = $pelanggaranMahasiswaModel->getDetailDaftarPelanggaran($id, idUser: $idUser, isDpa: true, condition: $condition);
            // var_dump($detail);
            return $detail;
        } else if (in_array($role, ['sekjur', 'kps', 'admin', 'dosen'])) {
            $detail = $pelanggaranMahasiswaModel->getDetailDaftarPelanggaran($id, idUser: $idUser, condition:$condition);
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
        return $detail;
    } else {
        return false;
    }
}

function tingkatPelanggaran($id){
    if (isLogin()) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();
        $tingkat = $pelanggaranMahasiswaModel->getTingkatPelanggaranForDetailDaftarPelanggaran($id);
        return $tingkat;
    }
}
?>