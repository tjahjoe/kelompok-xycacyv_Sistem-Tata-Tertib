<?php
require_once __DIR__ . "/../models/PelanggaranMahasiswa.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Mahasiswa.php";
require_once __DIR__ . "/../models/Dosen.php";
require_once __DIR__ . "/../models/Admin.php";
require_once __DIR__ . "/../models/TingkatPelanggaran.php";
require_once __DIR__ . "/getData.php";


$pelanggaranModel = new PelanggaranMahasiswa();

// // var_dump(tingkatPelanggaran(13));
// // var_dump($pelanggaranModel->getDataPelanggaranByPelapor("198912032017095008"))
// public function getDaftarPelaporanByFilter($nim, $tanggalAwal, $tanggalAkhir, $tingkat, $status, $num, $id = '', $isDpa = false)
    
// var_dump($pelanggaranModel->getDaftarPelaporanByFilter('2','','', '', '', 1, '198006152010121001', true));
// // $userModel = new User();
// // var_dump($userModel->login('197901172012042003', '197901172012042003'));
// $model = new Mahasiswa();
// $modeld = new Dosen();
// $modela = new Admin();
// // var_dump($modela->getDataAdmin('198201172012042003'));
// // var_dump($model->getDataMahasiswa('2341721001'));
// // var_dump($modeld->getDataDosen('198006152010121001'));

// var_dump(dataPelanggaranPagination(0));

// var_dump(isset($_SESSION['filter']['nim']));


// var_dump($pelanggaranModel->getDetailDaftarPelanggaran('14', true, 198505022011031002));

// var_dump(tingkatPelanggaran(1));

// $tingkat = new TingkatPelanggaran();

// var_dump($tingkat->getSanksiByTingkat(1));

// var_dump($pelanggaranModel->uploadPelanggaran( '2341721001', '2024-11-23','on', 198912032017095008, 'Berbusana tidak sopan dan tidak rapi', false));
// var_dump(dataPelanggaran());
// var_dump(detailPelaporan(45, true));

// var_dump($pelanggaranModel->getTingkatPelanggaranForDetailDaftarPelanggaran(44));
var_dump(tingkatPelanggaran(45));
?>

<?php
// require_once __DIR__ . "/check.php";
// $_SESSION['user']['id_users'] = '198912032017095008';
// var_dump(isLogin());
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="FilterDaftarPelaporan.php" method="post">
        <label for="nim">label</label>
        <input type="text" name="searchNim" id="nim">
        <label for="nim">tanggalAwal</label>
        <input type="text" name="startTanggalPelaporan" id="nim">
        <label for="nim">tanggalAkhir</label>
        <input type="text" name="endTanggalPelaporan" id="nim">
        <label for="nim">tingkat</label>
        <input type="text" name="tingkatPelaporan" id="nim">
        <label for="nim">status</label>
        <input type="text" name="statusPelaporan" id="nim">
        <input type="submit" name="submit" id="submit">
    </form>
</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="uploadTingkat.php" method="post">
        <label for="id">id</label>
        <input type="text" name="id" id="id">
        <br>
        <label for="nim">status</label>
        <input type="text" name="status" id="nim">
        <br>
        <label for="nim">tingkat</label>
        <input type="text" name="tingkatPelanggaran" id="tingkatPelanggaran">
        <br>
        <input type="submit" value="submit">
    </form>
</body>

</html>