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
      <div class="flex-between">
        <div class="info-box">
          <label for="">Informasi</label>
          <p>Untuk menebus sanksi atas pelanggaran, silakan hubungi admin untuk informasi lebih lanjut.</p>
        </div>
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
      <div class="detail-container">
        <div class="detail-item">
          <label for="">Tingkat Pelanggaran</label>
          <p>I</p>
        </div>
        <div class="detail-item">
          <label for="">Tanggal Pelanggaran</label>
          <p>21/05/2024</p>
        </div>
        <div class="detail-item">
          <label for="">NIM Pelanggar</label>
          <p>2341598644789</p>
        </div>
        <div class="detail-item">
          <label for="">Akumulasi Pelanggaran</label>
          <p>5</p>
        </div>
        <div class="detail-item">
          <label for="">Nama Pelanggaran</label>
          <p>Lorem ipsum Judul Masalah berada disini. Lorem ipsum lorem ipsum</p>
        </div>
        <div class="detail-item">
          <label for="">Catatan</label>
          <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Varius suscipit curae penatibus taciti efficitur consectetur pulvinar, diam purus. Consequat nascetur maximus augue odio lobortis tristique nam. Eget ultricies lacinia nunc scelerisque venenatis. Facilisi ad diam lobortis iaculis convallis phasellus; faucibus sem. </p>
        </div>
        <div class="detail-item">
          <label for="">Sanksi</label>
          <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Varius suscipit.</p>
        </div>
        <div class="detail-item">
          <label for="">Status</label>
          <div class="badge-contain">
            <span class="badge badge-green">Completed</span>
            <span class="badge badge-gray">Pending</span>
            <span class="badge badge-gray">Rejected</span>
          </div>
        </div>
      </div>
    </form>
    <div class="danger-box">
      <label for="">Lampiran</label>
      <p>Untuk pelanggaran tingkat III hingga V, Anda dapat mengunduh <a href="#" style="text-decoration: underline; color:var(--red-color);">file template di sini.</a></p>
    </div>
  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>