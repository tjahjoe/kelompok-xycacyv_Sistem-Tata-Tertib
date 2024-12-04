<?php
include 'components/emptyState.php';
include 'components/navbar.php';
include 'components/table.php';
include 'components/alert.php';
include 'components/kelolaTatib.php';
include 'components/editProfile.php';
include 'components/infoProfile.php';
include 'components/sidebar.php';

require_once '../app/controllers/getData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil User | SiTatib</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="../assets/images/logo-sitatib.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <!-- DATA -->
  <?php
    $user_data = dataUser(); // data user
    $dataPelanggaran = dataPelanggaran(); //data pelanggaran user
    $dataListPelanggaran = ListPelanggaran(); //data list tatib
    $dataPelaporan = dataPelapor(); //data pelaporan dari user
  ?>

  <!-- NAVBAR -->
  <?php Navbar(true); ?>
  <div class="container pt-5">
    <h1 class="title">Pengaturan Akun</h1>
    <div class="box-content">
      <!-- SIDEBAR -->
      <?php Sidebar($user_data); ?>

      <!-- PROFILE USER -->
      <div id="profile-user" class="tab-content active">
        <div class="head-tab-content">
          <h2>Profil Saya</h2>
        </div>
        <?php InfoProfile($user_data);?>
      </div>

      <!-- EDIT PROFILE -->
      <div id="edit-profile" class=" content-edit-profile">
        <div class="head-tab-content">
          <h2>Profil Saya / Edit Informasi Pribadi</h2>
          <p class="text-gray">Di sini Anda dapat mengubah informasi pribadi Anda. Setelah selesai, tekan tombol 'Simpan'.</p>
        </div>
        <?php EditProfile($user_data); ?>
      </div>

      <!-- RIWAYAT PELANGGARAN -->
      <div class="tab-content" id="riwayat-pelanggaran">
        <div class="head-tab-content">
          <h2>Riwayat Pelanggaran</h2>
        </div>
        <?php
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
            <h2>Kelola Peraturan Tata Tertib</h2>
          </div>
          <?php KelolaTatib($dataListPelanggaran); ?>
        </div>

        <!-- KELOLA SURAT PERNYATAAN -->
        <div class="tab-subcontent" id="kelola-surat-pernyataan">
          <div class="head-tab-content">
            <h3>Update Surat Pernyataan</h3>
          </div>

          <div id="error-updateSurat" style="color: red; display:none"></div>

          <form id="updateSuratPernyataan" class="flex-row-full m-0">
            <label class="upload-section" for="lampiran">
              <span class="upload-icon"><img src="../assets/images/upload-surat-icon.svg" width="30px" alt=""></span>
              <p>Upload Lampiran (Max: 5MB)</p>
            </label>
            <input type="file" name="suratPernyataan" id="lampiran" placeholder="Ketik nama pelanggaran di sini..." required hidden accept=".docx">
          </form>
          <div class="list-file-uploaded">
            <h4 id="file-count"></h4>
            <ul id="file-list">
            </ul>
          </div>
        </div>
      </div>

      <!-- RIWAYAT PELAPORAN -->
      <div class="tab-content" id="riwayat-pelaporan">
        <div class="head-tab-content">
          <h2>Riwayat Pelaporan</h2>
        </div>
        <?php
        if ($dataPelaporan) {
          TableContent($dataPelaporan, 'detail-pelaporan');
        } else {
          EmptyState('EmptyStatePelaporan.png', 'Tidak ada riwayat pelaporan');
        }
        ?>
      </div>
      
      <!-- ALERT -->
      <?php
      // ALERT LOGOUT
      Alert('logout-icon.svg', 'Logout', 'Apakah Anda yakin ingin keluar dari akun?', true, 'alert-logout');

      // ALERT HAPUS FOTO
      Alert('alert-delete-icon.svg', 'Hapus Photo', 'Apakah Anda yakin ingin menghapus photo?', true, 'alert-delete-photo');

      // ALERT HAPUS TATIB
      Alert('alert-delete-icon.svg', 'Hapus TataTertib', 'Apakah Anda yakin ingin menghapus tata tertib?', true, 'alert-delete-tatib');

      // ALERT SUCCESS ADD TATIB
      Alert('alert-success-icon.svg', 'Berhasil', 'Berhasil menambahkan tata tertib baru', false, 'alert-success-add-tatib');

      // ALERT SUCCESS UPDATE TATIB
      Alert('alert-success-icon.svg', 'Berhasil', 'Berhasil update tata tertib', false, 'alert-success-update-tatib');

      // ALERT SUCCESS UPDATE PHOTO PROFIL
      Alert('alert-success-icon.svg', 'Berhasil', 'Berhasil update photo profil', false, 'alert-success-update-photo');

      // ALERT SUCCESS UPDATE INFO PRIBADI
      Alert('alert-success-icon.svg', 'Berhasil', 'Berhasil update data informasi pribadi', false, 'alert-success-update-infoprofil');

      // ALERT SUCCESS UPDATE SURAT PERNYATAAN
      Alert('alert-success-icon.svg', 'Berhasil', ' Berhasil update Surat Pernyataan', false, 'alert-success-update-surat');
      ?>

    </div>
  </div>
  </div>
  <script src="../assets/js/handleTataTertib.js"></script>
  <script src="../assets/js/handleUpdateSurat.js"></script>
  <script src="../assets/js/handleEditProfile.js"></script>
  <script src="../assets/js/handleLogout.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>