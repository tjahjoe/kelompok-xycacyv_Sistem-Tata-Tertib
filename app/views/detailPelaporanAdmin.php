<?php include 'components/emptyState.php'; ?>
<?php
include 'components/navbar.php';
require_once '../app/controllers/getData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Pelaporan - Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php Navbar(true); ?>
  <?php
  $data = detailPelaporan($_GET['id']);
  ?>
  <div class="container pt-5">
    <h1 class="title">Detail Pelaporan</h1>
    <?php
    if (!empty($data)) {
      $dataTingkatPelanggaran = tingkatPelanggaran($_GET['id']);
      foreach($dataTingkatPelanggaran as $tingkat){
        $tingkatPelanggaran = $tingkat['tingkat_pelanggaran'];
      }
      $status = $data['Status'];
    ?>
    <div class="info-laporan">
      <p><strong>ID Laporan:</strong>
      <?php echo $data['id']; ?></p>
      <p><strong>Nama Pelapor:</strong> <?php echo $data['Nama Pelapor']; ?></p>
      <p><strong>ID pelapor:</strong> <?php echo $data['NIP Pelapor']; ?></p>
    </div>
    <form id="updatePelaporan" method="post">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <div class="detail-container">
        <div class="detail-item">
          <label for="tingkatPelanggaran">Tingkat Pelanggaran</label>
          <select id="tingkatPelanggaran" name="tingkatPelanggaran" required>
            <option value="I" <?php echo $tingkatPelanggaran == 'I' ? 'selected' : ''; ?>>I</option>
            <option value="I/II" <?php echo $tingkatPelanggaran == 'I/II' ? 'selected' : ''; ?>>I/II</option>
            <option value="II" <?php echo $tingkatPelanggaran == 'II' ? 'selected' : ''; ?>>II</option>
            <option value="III" <?php echo $tingkatPelanggaran == 'III' ? 'selected' : ''; ?>>III</option>
            <option value="IV" <?php echo $tingkatPelanggaran == 'IV' ? 'selected' : ''; ?>>IV</option>
            <option value="V" <?php echo $tingkatPelanggaran == 'V' ? 'selected' : ''; ?>>V</option>
          </select>
        </div>
        <div class="detail-item">
          <label for="tanggalPelanggaran">Tanggal Pelanggaran</label>
          <input type="date" name="tanggalPelanggaran" id="tanggalPelanggaran" class="custom-date"
            value="<?php echo $data['Tanggal Pelanggaran']; ?>">
        </div>
        <div class="detail-item">
          <label for="nimPelanggar">NIM Pelanggar</label>
          <input type="text" name="nimPelanggar" value="<?php echo $data['NIM Pelanggar']; ?>" id="nimPelanggar" disabled>
        </div>
        <div class="detail-item">
          <label for="namaPelanggaran">Nama Pelanggaran</label>
          <input type="text" name="namaPelanggaran" value="<?php echo $data['Nama Pelanggaran']; ?>" id="namaPelanggaran">
        </div>
        <div class="detail-item">
          <label for="catatan">Catatan</label>
          <textarea name="catatan" rows="10" id="catatan"><?php echo $data['Catatan']; ?></textarea>
        </div>
        <div class="detail-item">
          <label for="sanksi">Sanksi</label>
          <input type="text" name="sanksi" value="<?php echo $data['Sanksi']; ?>" id="sanksi">
        </div>
        <div class="detail-item">
          <label for="">Status</label>
          <div class="badge-contain">
            <input type="radio" name="status" id="status-pending" value="baru" <?php echo $status == 'baru' ? 'checked' : ''; ?>>
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
    }else{
      echo "<p style='margin:20px auto;'>Data is not available</p>";
    }
    ?>

    <a href="daftar-pelaporan.php" class="btn btn-primary">Kembali</a>
  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>