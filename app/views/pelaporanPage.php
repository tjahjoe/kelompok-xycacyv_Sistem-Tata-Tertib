<?php
include 'components/navbar.php';
include 'components/headerSection.php';
include 'components/alert.php';
require_once '../app/controllers/getData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pelaporan | SiTatib</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="../assets/images/logo-sitatib.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <!-- NAVBAR -->
  <?php Navbar(false); ?>

  <!-- HEADER SECTION -->
  <?php HeaderSection("Pengaduan Online Mahasiswa Teknik Informatika", "Kejujuran adalah dasar dari semua kebajikan. Tanpa kejujuran, tidak ada integritas, dan tanpa integritas, tidak ada kepercayaan. Dalam pendidikan, kejujuran adalah kunci untuk membangun karakter yang kuat dan masyarakat yang adil. - Mahatma Gandhi", false); ?>

  <?php $data = ListPelanggaran() ?>

  <!-- FORM -->
  <div class="modal-box">
    <h2>Laporan anda:</h2>
    <div id="hasil" style="color: red; display:none; margin-bottom: 10px;"></div>
    <form class="form-container" id="form-pelaporan" enctype="multipart/form-data">
      <input type="text" placeholder="Masukkan NIM Pelanggar *" name="nim" class="input-field" required>
      <select id="tingkatPelanggaran" class="tingkatPelanggaran input-field" name="tingkatPelanggaran" required>
        <option disabled selected hidden>PIlih Tingkat Pelanggaran *</option>
        <option value="">All</option>
        <option value="I">I</option>
        <option value="I/II">I/II</option>
        <option value="II">II</option>
        <option value="III">III</option>
        <option value="IV">IV</option>
        <option value="V">V</option>
      </select>
      <select id="jenisPelanggaran" class="jenisPelanggaran input-field" name="jenisPelanggaran" required>
        <option disabled selected hidden>PIlih Jenis Pelanggaran *</option>
        <?php if (!empty($data)) {
          foreach ($data as $record) {
        ?>
            <option value="<?php echo $record['nama_jenis_pelanggaran'] ?>"><?php echo $record['nama_jenis_pelanggaran'] ?></option>
        <?php }
        } ?>
      </select>
      <textarea placeholder="Ketik Laporan Anda *" class="input-field" rows="10" name="deskripsiLaporan" required></textarea>
      <div class="footer-modal">
        <label class="upload-section" for="lampiran">
          <span class="upload-icon"><img src="../assets/images/upload-image-icon.svg" width="30px" alt=""></span>
          <p>Upload Lampiran (Max: 2MB)</p>
        </label>
        <input type="file" name="lampiran[]" id="lampiran" accept="image/*" hidden multiple>
        <button type="submit" class="btn btn-red">Laporkan!</button>
      </div>
      <div class="list-file-uploaded">
        <h4 id="file-count">0 file uploaded</h4>
        <ul id="file-list">
        </ul>
      </div>
    </form>
  </div>

  <!-- ALERT -->
  <?php Alert('alert-success-icon.svg', 'Berhasil', 'Laporan berhasil terkirim.', false, 'alert-pelaporan-success'); ?>

  <script src="../assets/js/handlePelaporan.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>