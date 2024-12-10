<?php
require_once __DIR__ . "/actions/UsersController.php";
require_once __DIR__ . "/actions/ListPelanggaranController.php";
require_once __DIR__ . "/actions/PelanggaranMahasiswaController.php";
require_once __DIR__ . "/actions/TemplateController.php";
require_once __DIR__ . "/actions/WordGeneratorController.php";

$usersController = new UsersController();
$listPelanggaranController = new ListPelanggaranController();
$pelanggaranMahasiswaController = new PelanggaranMahasiswaController();
$templateController = new TemplateController();
$wordGeneratorController = new WordGeneratorController();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'login') {//user
    $usersController->login();
} else if ($action == 'logout') {//user
    $usersController->logoutHandler();
} else if ($action == 'uploadUser') {//user
    $usersController->uploadUser();
} else if ($action == 'updateUser') {//user
    $usersController->updateUser();
} else if ($action == 'uploadPelanggaran') {//PelanggaranMahasiswa
    $pelanggaranMahasiswaController->uploadPelanggaran();
} else if ($action == 'updatePelanggaran') {//pelanggaranMahasiswa
    $pelanggaranMahasiswaController->updatePelanggaran();
} else if ($action == 'uploadListPelanggaran') {//listpelanggaran
    $listPelanggaranController->uploadListPelanggaran();
} else if ($action == 'updateListPelanggaran') {//listpelanggaran
    $listPelanggaranController->updateListPelanggaran();
} else if ($action == 'deleteListPelanggaran') {//listpelanggaran
    $listPelanggaranController->deleteListPelanggaran();
} else if ($action == 'updateDataUser') {//user
    $usersController->updateDataUser();
} else if ($action == 'updatePhotoProfil') {//user
    $usersController->updatePhotoProfil();
} else if ($action == 'deletePhotoProfil') {//user
    $usersController->deletePhotoProfil();
} else if ($action == 'updateSuratPeringatan') {//tamplate
    $templateController->updateSuratPeringatan();
} else if ($action == 'suratPeringatan') {//wordgenerator
    $wordGeneratorController->generateWordFromTemplate();
}
?>