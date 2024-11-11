<?php
require_once __DIR__ . "/../models/ListPelanggaran.php";
require_once __DIR__ . "/../models/Mahasiswa.php";
require_once __DIR__ . "/../models/Dosen.php";
require_once __DIR__ . "/../models/Admin.php";
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";

function ListPelanggaran(){
    $listPelanggaranModel = new ListPelanggaran();
    $listPelanggaran = $listPelanggaranModel->getAllListPelanggaran();
    return $listPelanggaran;
}

function dataUser(){
    if(isset($_SESSION['user'])){
        $id = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];
        if ($role == 'mahasiswa') {
            $mahasiswaModel = new Mahasiswa();
            $dataMahasiwa = $mahasiswaModel->getDataMahasiswaByMahasiswa($id);
            return $dataMahasiwa;
        } else if (in_array($role, ['dpa', 'sekjur', 'dosen', 'kps'] )) {
            $dosenModel = new Dosen();
            $dataDosen = $dosenModel->getDataDosen($id);
            return $dataDosen;
        } else if ($role == 'admin'){
            $adminModel = new Admin();
            $dataAdmin = $adminModel->getDataAdmin($id);
            return $dataAdmin;
        }
    } else {
        // arah login
    }
}

function dataPelanggaran(){
    if (isset($_SESSION['user'])) {
        $pelanggaranMahasiswaModel = new PelanggaranMahasiswa();

        $id = $_SESSION['user']['id_users'];
        $role = $_SESSION['user']['role'];

        if ($role == 'mahasiswa') {
            $dataPelanggaran = $pelanggaranMahasiswaModel->getDataPelanggaranByPelanggar($id);
            return $dataPelanggaran;
        } else if ($role == 'dpa'){
            $dataPelanggaran = $pelanggaranMahasiswaModel->getDataPelanggaranByDpa($id);
            return $dataPelanggaran;
        } else if (in_array($role, ['sekjur', 'kps', 'admin'])){
            $dataPelanggaran = $pelanggaranMahasiswaModel->getAllDataPelanggaran();
            return $dataPelanggaran;
        }
    }  else{
        
    }
}

$_SESSION['user']['id_users'] = '2341721001';
$_SESSION['user']['role'] = 'mahasiswa';

// var_dump(dataPelanggaran());
var_dump(dataUser());
?>