<?php
require_once __DIR__ . "/post/User.php";
require_once __DIR__ . "/post/PelanggaranMahasiswa.php";
require_once __DIR__ . "/post/ListPelanggaran.php";

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'login') {//user
    login();
} else if ($action == 'uploadPelanggaran') {//PelanggaranMahasiswa
    uploadPelanggaran();
} else if ($action == 'updatePelanggaran') {//pelanggaranMahasiswa
    updatePelanggaran();
} else if ($action == 'uploadListPelanggaran') {//listpelanggaran
    uploadListPelanggaran();
} else if ($action == 'updateListPelanggaran') {//listpelanggaran
    updateListPelanggaran();
} else if ($action == 'deleteListPelanggaran') {//listpelanggaran
    deleteListPelanggaran();
} else if ($action == 'updateDataUser') {//user
    updateDataUser();
} else if ($action == 'updatePhotoProfil') {//user
    updatePhotoProfil();
} else if ($action == 'deletePhotoProfil') {//user
    deletePhotoProfil();
}
?>