<?php
include 'components/emptyState.php';
include 'components/alert.php';
include 'components/navbar.php';
include 'components/buktiBox.php';
require_once '../app/controllers/getData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Pelaporan - Admin | SiTatib</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="../assets/images/logo-sitatib.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <!-- NAVBAR -->
  <?php Navbar(true); ?>

  <!-- DATA -->
  <?php
  $data = detailPelaporan($_GET['id'], true); //data detail pelaporan

  $dataTingkatPelanggaran = tingkatPelanggaran($_GET['id']);
  ?>

  <div class="container pt-5">
    <h1 class="title">Detail Pelaporan</h1>
    <?php
    if (!empty($data)) {
      $idLaporan = $data['id'];
      $namaPelapor = $data['Nama Pelapor'];
      $idPelapor = $data['NIP Pelapor'];
      $status = strtolower($data['Status']);
      $tingkatSanksi = $data['Tingkat Sanksi'] ?? null;
      $sanksi = $data['sanksi'] ?? null;
      $tingkatPelanggaran = $data['Tingkat Pelanggaran'];
      $tanggalPelanggaran = $data['Tanggal Pelanggaran'];
      $nimPelanggar = $data['NIM Pelanggar'];
      $namaPelanggaran = $data['Nama Pelanggaran'];
      $catatan = $data['Catatan'];
      $bukti = $data['Bukti'];

      $roleUser = $_SESSION['user']['role'];
      $notHakAksesDpa = $roleUser == 'dpa' && !in_array($tingkatPelanggaran, ['V', 'IV', "III"]);

    ?>
      <form id="updatePelaporan" method="post">
        <div class="flex-between items-end">
          <div class="info-laporan">
            <p><strong>ID Laporan:</strong> <?php echo $idLaporan ?></p>
            <p><strong>Nama Pelapor:</strong> <?php echo $namaPelapor ?></p>
            <p><strong>ID pelapor:</strong> <?php echo $idPelapor ?></p>
          </div>

          <?php if ($notHakAksesDpa) {
            echo '<p style="color: red;">Pemberitahuan: DPA tidak bisa memproses pelanggaran diatas tingkat III!</p>';
          }
          ?>

          <div class="flex-row m-0">
            <?php if ($notHakAksesDpa) {
              echo '';
            } else {
              echo '<button class="btn btn-primary" type="submit">Simpan</button>';
            } ?>
            <a href="daftar-pelaporan.php?page=1" class="btn btn-gray">Kembali</a>
          </div>
        </div>
        <div class="detail-container">
          <!-- error message -->
          <div id="hasil" style="color: red; display:none"></div>

          <!-- id pelanggaran mhs -->
          <input type="hidden" name="idPelanggaranMhs" value="<?php echo $data['id']; ?>" id="idPelanggaranMhs">

          <div class="detail-item">
            <label for="tingkatPelanggaranAdmin">Tingkat Pelanggaran</label>
            <input type="text" name="tingkatPelanggaranAdmin" value="<?php echo $tingkatPelanggaran; ?>" id="tingkatPelanggaranAdmin" disabled>
          </div>
          <div class="detail-item">
            <label for="tingkatSanksiAdmin">Tingkat Sanksi</label>

            <?php
              if ($tingkatSanksi) { ?>
                <input type="hidden" name="tingkatSanksiAdmin" value="<?= $tingkatSanksi ?>">
            <?php }?>

            <?php
            if ($status != 'reject') {
            ?>
              <select id="tingkatSanksiAdmin" name="tingkatSanksiAdmin" required <?php echo $tingkatSanksi || $notHakAksesDpa ? 'class="no-dropdown" disabled' : ''; ?>>
                <?php
                if ($tingkatSanksi) {
                  echo "<option value='$tingkatSanksi' selected>$tingkatSanksi</option>";
                } else {
                  echo "<option disabled selected hidden>Pilih Tingkat</option>";
                  foreach ($dataTingkatPelanggaran as $tingkat) {
                    $tingkatSanksi = $tingkat['id_sanksi'];
                    echo "<option value='$tingkatSanksi'>$tingkatSanksi</option>";
                  }
                }
                ?>
              </select>
            <?php
            } else {
              echo "<p>-</p>";
            }
            ?>
          </div>
          <div class="detail-item">
            <label for="tanggalPelanggaran">Tanggal Pelanggaran</label>
            <input type="date" name="tanggalPelanggaran" id="tanggalPelanggaran" class="custom-date" value="<?php echo $tanggalPelanggaran ?>" disabled>
          </div>
          <div class="detail-item">
            <label for="nimPelanggar">NIM Pelanggar</label>
            <input type="text" name="nimPelanggar" value="<?php echo $nimPelanggar ?>" id="nimPelanggar" disabled>
          </div>
          <div class="detail-item">
            <label for="namaPelanggaran">Nama Pelanggaran</label>
            <input type="text" name="namaPelanggaran" value="<?php echo $namaPelanggaran ?>" id="namaPelanggaran" disabled>
          </div>
          <div class="detail-item">
            <label for="catatan">Catatan</label>
           <textarea name="catatan" rows="10" id="catatan" <?php echo $notHakAksesDpa ? 'disabled' : ''; ?>>
              <?php echo $catatan; ?>
          </textarea>

          </div>
          <div class="detail-item">
            <label for="bukti">Lampiran</label>
            <div class="flex-row-start">
              <?php
              if ($bukti) {
                $totalFileNotFound = 0;
                foreach ($bukti as $image) {
                  $filePath = "../assets/uploads/bukti/$image";
                  if (file_exists($filePath)) {
                    echo "<img src='$filePath' class='lampiran_bukti' alt='Bukti' width='200px'>";
                  } else {
                    $totalFileNotFound++;
                  }
                }
                if ($totalFileNotFound > 0) {
                  echo "<p>Beberapa bukti tidak ditemukan!</p>";
                }
              } else {
                echo "<p>Bukti tidak ada!</p>";
              }
              ?>
            </div>
          </div>
          <div class="detail-item">
            <label for="sanksi">Sanksi</label>
            <input type="text" name="sanksi" value="<?php echo $sanksi ?>" id="sanksi" disabled>
          </div>
          <div class="detail-item" <?php echo $notHakAksesDpa ? 'style="pointer-events: none;"' : ''; ?> >
            <label for="">Status</label>
            <div class="badge-contain">
              <input type="radio" name="status" id="status-pending" value="baru" <?php echo $status == 'baru' ? 'checked' : '';?>>
              <label class="badge badge-gray" for="status-pending">Pending</label>

              <input type="radio" name="status" id="status-completed" value="nonaktif" <?php echo $status == 'nonaktif' ? 'checked' : ''; ?>>
              <label class="badge badge-gray" for="status-completed">Completed</label>

              <input type="radio" name="status" id="status-processing" value="aktif" <?php echo $status == 'aktif' ? 'checked' : ''; ?>>
              <label class="badge badge-gray" for="status-processing">Processing</label>

              <input type="radio" name="status" id="status-rejected" value="reject" <?php echo $status == 'reject' ? 'checked' : ''; ?>>
              <label class="badge badge-gray" for="status-rejected">Rejected</label>
            </div>
          </div>
        </div>
      </form>
    <?php
    } else {
      echo "<p style='margin:20px auto;'>Data is not available</p>";
    }
    ?>

    <?php BuktiBox(); ?>

    <!-- ALERT -->
    <?php Alert('alert-success-icon.svg', 'Berhasil', 'Laporan berhasil di ubah.', false, 'alert-detail-pelaporan-success'); ?>

  </div>
  <script src="../assets/js/handlePelaporan.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>