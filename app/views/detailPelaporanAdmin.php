<?php include 'components/emptyState.php'; ?>
<?php include 'components/navbar.php'; ?>

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
  <div class="container pt-5">
    <h1 class="title">Detail Pelaporan</h1>
    <div class="info-laporan">
      <p><strong>ID Laporan:</strong> 23199122</p>
      <p><strong>Nama Pelapor:</strong> Sopo ae ws</p>
      <p><strong>ID pelapor:</strong> 23199122332</p>
    </div>
    <form id="updatePelaporan" method="post">
        <button class="btn btn-primary" type="submit">Simpan</button>
      <div class="detail-container">
        <div class="detail-item">
          <label for="tingkatPelanggaran">Tingkat Pelanggaran</label>
          <select id="tingkatPelanggaran" name="tingkatPelanggaran">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
        <div class="detail-item">
          <label for="tanggalPelanggaran">Tanggal Pelanggaran</label>
          <input type="date" name="tanggalPelanggaran" id="tanggalPelanggaran" class="custom-date">
        </div>
        <div class="detail-item">
          <label for="nimPelanggaran">NIM Pelanggar</label>
          <input type="text" name="nimPelanggaran" value="2341598644789" id="nimPelanggaran" disabled>
        </div>
        <div class="detail-item">
          <label for="namaPelanggaran">Nama Pelanggaran</label>
          <input type="text" name="namaPelanggaran" value="Lorem ipsum Judul Masalah berada disini. Lorem ipsum lorem ipsum" id="namaPelanggaran">
        </div>
        <div class="detail-item">
          <label for="catatan">Catatan</label>
          <textarea name="catatan" rows="10" id="catatan">Lorem ipsum odor amet, consectetuer adipiscing elit. Varius suscipit curae penatibus taciti efficitur consectetur pulvinar, diam purus. Consequat nascetur maximus augue odio lobortis tristique nam. Eget ultricies lacinia nunc scelerisque venenatis. Facilisi ad diam lobortis iaculis convallis phasellus; faucibus sem.</textarea>
        </div>
        <div class="detail-item">
          <label for="sanksi">Sanksi</label>
          <input type="text" name="sanksi" value="Lorem ipsum odor amet, consectetuer adipiscing elit. Varius suscipit." id="sanksi">
        </div>
        <div class="detail-item">
          <label for="">Status</label>
          <div class="badge-contain">
            <input type="radio" name="status" id="status-pending" value="baru">
            <label class="badge badge-gray" for="status-pending">Pending</label>

            <input type="radio" name="status" id="status-completed" value="nonaktif" checked>
            <label class="badge badge-green" for="status-completed">Completed</label>

            <input type="radio" name="status" id="status-processing" value="aktif">
            <label class="badge badge-gray" for="status-processing">Processing</label>

            <input type="radio" name="status" id="status-rejected" value="reject">
            <label class="badge badge-gray" for="status-rejected">Rejected</label>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>
