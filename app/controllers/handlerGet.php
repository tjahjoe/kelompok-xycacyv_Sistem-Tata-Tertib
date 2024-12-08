<?php
require_once __DIR__ . "/get/ListPelanggaran.php";
require_once __DIR__ . "/get/PelanggaranMahasiswa.php";
require_once __DIR__ . "/get/TingkatPelanggaran.php";
require_once __DIR__ . "/get/User.php";

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'filterUsers') {//user
    filterUserById();
} else if ($action == 'filterListPelanggaranByTingkat') {//listpelanggaran
    filterListPelanggaranByTingkat();
} else if ($action == 'filterListPelanggaranById') {//listpelanggaran
    filterListPelanggaranById();
} else if ($action == 'filterDaftarPelaporan') {//pelanggaranmahasiswa
    filterDaftarPelaporan();
} else if ($action == 'filterSanksiByTingkat') {//tingkatpelanggaran
    filterSanksiByTingkat();
}
?>