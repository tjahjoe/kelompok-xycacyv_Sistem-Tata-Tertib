<?php
require_once __DIR__ . "/get/ListPelanggaran.php";
require_once __DIR__ . "/get/PelanggaranMahasiswa.php";
require_once __DIR__ . "/get/TingkatPelanggaran.php";

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'filterListPelanggaranByTingkat') {//listpelanggaran
    filterListPelanggaranByTingkat();
} else if ($action == 'filterListPelanggaranById') {//listpelanggaran
    filterListPelanggaranById();
} else if ($action == 'filterDaftarPelaporan') {//pelanggaranmahasiswa
    filterDaftarPelaporan();
} else if ($action == 'filterSanksiByTingkat') {//tingkatpelanggaran
    filterSanksiByTingkat();
}
?>