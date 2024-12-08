<?php
require_once __DIR__ . "/post/User.php";
require_once __DIR__ . "/post/PelanggaranMahasiswa.php";
require_once __DIR__ . "/post/ListPelanggaran.php";
require_once __DIR__ . "/post/Tamplate.php";
require_once __DIR__ . "/post/WordGenerator.php";

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'login') {//user
    login();
} else if ($action == 'logout') {//user
    logoutHandler();
} else if ($action == 'uploadUser') {//user
    uploadUser();
} else if ($action == 'updateUser') {//user
    updateUser();
} else if ($action == 'deleteUser') {//user
    DeleteUser();
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
} else if ($action == 'updateSuratPeringatan') {//tamplate
    updateSuratPeringatan();
} else if ($action == 'suratPeringatan') {//wordgenerator
    generateWordFromTemplate();
}
?>