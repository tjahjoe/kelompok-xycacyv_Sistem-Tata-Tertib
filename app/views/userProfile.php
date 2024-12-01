<?php
include 'components/emptyState.php';
include 'components/navbar.php';
include 'components/table.php';
include 'components/alert.php';
include 'components/kelolaTatib.php';
include 'components/editProfile.php';
?>

<?php
require_once '../app/controllers/getData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile User</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php Navbar(true); ?>
  <div class="container bg-gray pt-5">
    <h1 class="title">Pengaturan Akun</h1>
    <div class="box-content">
      <!-- SIDEBAR -->
      <?php include 'components/sidebar.php'; ?>

      <!-- PROFILE USER -->
      <div id="profile-user" class="tab-content active">
        <div class="head-tab-content">
          <h1>Profil Saya</h1>
        </div>
        <?php include 'components/infoProfile.php';

        $user_data = dataUser();
        InfoProfile($user_data);
        ?>
      </div>

      <!-- EDIT PROFILE -->
      <div id="edit-profile" class=" content-edit-profile">
        <div class="head-tab-content">
          <h1>Profil Saya / Edit Informasi Pribadi</h1>
          <p class="text-gray">Di sini Anda dapat mengubah informasi pribadi Anda. Setelah selesai, tekan tombol 'Simpan'.</p>
        </div>
        <?php EditProfile($user_data); ?>
      </div>

      <!-- RIWAYAT PELANGGARAN -->
      <div class="tab-content" id="riwayat-pelanggaran">
        <div class="head-tab-content">
          <h1>Riwayat Pelanggaran</h1>
        </div>
        <?php
        $dataPelanggaran = dataPelanggaran();

        if ($dataPelanggaran) {
          TableContent($dataPelanggaran, 'detail-pelanggaran');
        } else {
          EmptyState('EmptyState.png', 'Tidak ada riwayat pelanggaran');
        }
        ?>

      </div>

      <!-- Pengaturan Lanjutan -->
      <div class="tab-content" id="pengaturan-lanjutan">
        <div class="menu">
          <a href="#kelola-peraturan-tatib" class="tab-sublink active">Kelola Peraturan Tata Tertib </a>
          <a href="#kelola-surat-pernyataan" class="tab-sublink">Kelola Surat Pernyataan</a>
        </div>

        <!-- KELOLA TATIB -->
        <div class="tab-subcontent active" id="kelola-peraturan-tatib">
          <div class="head-tab-content">
            <h1>Kelola Peraturan Tata Tertib</h1>
          </div>
          <?php KelolaTatib(); ?>
        </div>

        <!-- KELOLA SURAT PERNYATAAN -->
        <div class="tab-subcontent" id="kelola-surat-pernyataan">
          <div class="head-tab-content">
            <h1>Kelola Surat Pernyataan</h1>
          </div>
        </div>
      </div>


      <!-- RIWAYAT PELAPORAN -->
      <div class="tab-content" id="riwayat-pelaporan">
        <div class="head-tab-content">
          <h1>Riwayat Pelaporan</h1>
        </div>
        <?php
        $dataPelaporan = dataPelapor();
        if ($dataPelaporan) {
          TableContent($dataPelaporan, 'detail-pelaporan');
        } else {
          EmptyState('EmptyStatePelaporan.png', 'Tidak ada riwayat pelaporan');
        }
        ?>
      </div>
      <!-- ALERT -->
      <?php
      Alert('logout-icon.svg', 'Logout', 'Apakah Anda yakin ingin keluar dari akun?', '', true, 'alert-logout');

      Alert('alert-delete-icon.svg', 'Hapus Photo', 'Apakah Anda yakin ingin menghapus photo?', '', true, 'alert-delete-photo');

      Alert('alert-delete-icon.svg', 'Hapus TataTertib', 'Apakah Anda yakin ingin menghapus tata tertib?', '', true, 'alert-delete-tatib');

      Alert('alert-success-icon.svg', 'Berhasil Tambah TataTertib', 'Berhasil menambahkan data baru', '', false, 'alert-success-add-tatib');

      Alert('alert-success-icon.svg', 'Berhasil Update TataTertib', 'Berhasil update data', '', false, 'alert-success-update-tatib');

      Alert('alert-success-icon.svg', 'Berhasil Update Photo', 'Berhasil update photo profil', '', false, 'alert-success-update-photo');

      Alert('alert-success-icon.svg', 'Berhasil Update Informasi Pribadi', 'Berhasil update data informasi pribadi', '', false, 'alert-success-update-infoprofil');
      ?>

    </div>
  </div>
  </div>
  <script src="../assets/js/handleTataTertib.js"></script>
  <script src="../assets/js/handleEditProfile.js"></script>
  <script src="../assets/js/handleLogout.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>