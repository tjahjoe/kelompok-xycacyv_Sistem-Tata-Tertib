<?php include 'components/emptyState.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Pelaporan</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php include 'components/navbar.php'; ?>
  <?php Navbar(true); ?>
  <div class="container pt-5">
    <h1 class="title">Detail Pelaporan</h1>
    <p><strong>ID Laporan:</strong> 23199122</p>
    <div class="detail-container">
      <div class="detail-item">
        <h4>Tingkat Pelanggaran</h4>
        <p>I</p>
      </div>
      <div class="detail-item">
        <h4>Tanggal Pelanggaran</h4>
        <p>21/05/2024</p>
      </div>
      <div class="detail-item">
        <h4>NIM Pelanggar</h4>
        <p>2341598644789</p>
      </div>
      <div class="detail-item">
        <h4>Akumulasi Pelanggaran</h4>
        <p>5</p>
      </div>
      <div class="detail-item">
        <h4>Nama Pelanggaran</h4>
        <p>Lorem ipsum Judul Masalah berada disini. Lorem ipsum lorem ipsum</p>
      </div>
      <div class="detail-item">
        <h4>Catatan</h4>
        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Varius suscipit curae penatibus taciti efficitur consectetur pulvinar, diam purus. Consequat nascetur maximus augue odio lobortis tristique nam. Eget ultricies lacinia nunc scelerisque venenatis. Facilisi ad diam lobortis iaculis convallis phasellus; faucibus sem. </p>
      </div>
      <div class="detail-item">
        <h4>Sanksi</h4>
        <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Varius suscipit.</p>
      </div>
      <div class="detail-item">
        <h4>Status</h4>
        <span class="badge badge-green">Completed</span>
      </div>
    </div>

    <a href="profile-user.php" class="btn btn-primary">Kembali</a>

  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>