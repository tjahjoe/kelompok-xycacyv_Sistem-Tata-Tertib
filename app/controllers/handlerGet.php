<?php
require_once __DIR__ . "/actions/UsersController.php";
require_once __DIR__ . "/actions/ListPelanggaranController.php";
require_once __DIR__ . "/actions/PelanggaranMahasiswaController.php";
require_once __DIR__ . "/actions/TingkatPelanggaranController.php";

$usersController = new UsersController();
$tingkatPelanggaranController = new TingkatPelanggaranController();
$listPelanggaranController = new ListPelanggaranController();
$pelanggaranMahasiswaController = new PelanggaranMahasiswaController();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'filterUsers') {//user
    $usersController->filterUserById();
} else if ($action == 'filterListPelanggaranByTingkat') {//listpelanggaran
    $listPelanggaranController->filterListPelanggaranByTingkat();
} else if ($action == 'filterListPelanggaranById') {//listpelanggaran
    $listPelanggaranController->filterListPelanggaranById();
} else if ($action == 'filterDaftarPelaporan') {//pelanggaranmahasiswa
    $pelanggaranMahasiswaController->filterDaftarPelaporan();
} else if ($action == 'filterSanksiByTingkat') {//tingkatpelanggaran
    $tingkatPelanggaranController->filterSanksiByTingkat();
}
?>