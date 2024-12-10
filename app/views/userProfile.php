<?php
include 'components/emptyState.php';
include 'components/navbar.php';
include 'components/table.php';
include 'components/alert.php';
include 'components/kelolaTatib.php';
include 'components/editProfile.php';
include 'components/infoProfile.php';
include 'components/sidebar.php';
include 'components/kelolaTemplateSurat.php';

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
  $usersData = dataUsers(); // data user
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
        <?php InfoProfile($user_data); ?>
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
        <div class="head-tab-content">
          <h2>Pengaturan Lanjutan</h2>
        </div>
        <div class="container-overflow">
        <div class="menu">
          <a href="#kelola-peraturan-tatib" class="tab-sublink active">Kelola Peraturan Tata Tertib </a>
          <a href="#kelola-surat-pernyataan" class="tab-sublink">Kelola Surat Pernyataan</a>
          <a href="#kelola-pengguna" class="tab-sublink">Kelola Pengguna</a>
        </div>
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

          <?php KelolaTemplateSurat() ?>
        </div>

        <!-- KELOLA USER -->
        <div class="tab-subcontent" id="kelola-pengguna">
          <div class="head-tab-content">
            <div class="flex-between m-0">
              <h3>Kelola Pengguna</h3>
              <a class="btn btn-primary" href="./tambah-user.php">Tambah Pengguna</a>
            </div>
          </div>
          <form id="search-user-nim" class="search-input-container">
            <input type="text" class="search-nim"
              placeholder="Tulis NIM yang ingin dicari..."
              name="searchNim" id="searchNim"
              value="">
            <button class="btn btn-gray"
              type="submit"><img src="../assets/images/send.svg"
                alt=""></button>
          </form>

          <div id="error-kelolaUser" style="color: red; display:none"></div>

          <div class="table-container">
            <table class="table-content">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>ID</th>
                  <th>NAMA</th>
                  <th>EMAIL</th>
                  <th>PEKERJAAN</th>
                  <th>TELEPON</th>
                  <th>STATUS</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($usersData)) {
                  $index = 0;
                ?>
                  <?php foreach ($usersData as $record) {
                    $index++;
                  ?>
                    <tr>
                      <td><?php echo $index ?></td>
                      <td class="text-left normal-white-space"><?php echo $record['ID'] ?></td>
                      <td class="text-left max-text truncate capitalize-text"><?php echo $record['NAMA'] ?></td>
                      <td><?php echo $record['EMAIL'] ?></td>
                      <td class="capitalize-text"><?php echo $record['PEKERJAAN'] ?></td>
                      <td><?php echo $record['TELEPON'] ?></td>
                      <td class="capitalize-text"><?php echo $record['STATUS'] ?></td>
                      <td><a href="detail-user.php?id=<?php echo $record['ID'] ?>&role=<?php echo $record['PEKERJAAN'] ?>">Detail</a></td>
                    </tr>
                <?php }
                } else {
                  echo "<tr><td colspan='8'>Data tidak tersedia!</td></tr>";
                } ?>
              </tbody>
            </table>
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
      Alert('alert-success-icon.svg', 'Berhasil', ' Berhasil update surat pernyataan', false, 'alert-success-update-surat');
      ?>

    </div>
  </div>
  </div>
  <script src="../assets/js/handleManageUser.js"></script>
  <script src="../assets/js/handleTataTertib.js"></script>
  <script src="../assets/js/handleUpdateSurat.js"></script>
  <script src="../assets/js/handleEditProfile.js"></script>
  <script src="../assets/js/handleLogout.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>