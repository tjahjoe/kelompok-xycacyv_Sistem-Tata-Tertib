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
  <?php include 'components/navbar.php'; ?>
  <?php Navbar(true); ?>
  <div class="container bg-gray pt-5">
    <h1 class="title">Pengaturan Akun</h1>
    <div class="box-content">
      <?php include 'components/sidebar.php'; ?>
      <div id="profile-user" class="tab-content active">
        <div class="head-profile">
          <h2>Profil Saya</h2>
          <p>Anda tidak dapat mengubah informasi pribadi di sini. Untuk mengubah informasi, silakan hubungi admin.</p>
        </div>
        <div class="box-profile">
          <div class="info-user">
            <img src="https://i.pinimg.com/474x/aa/d3/d6/aad3d691d8d8592bb8dd240de636f6a9.jpg" alt="Profile Picture" class="profile-image" />
            <span>
              <h3>Muhammad Syafiq Aldiansyah</h3>
              <p>Mahasiswa</p>
            </span>
          </div>
        </div>
        <div class="box-profile">
          <div class="info-personal">
            <h2>Informasi Pribadi</h2>
            <div class="info-grid">
              <span>
                <p>Nama Awal</p>
                <p>Muhammad Syafiq</p>
              </span>
              <span>
                <p>Nama Akhir</p>
                <p>Aldiansyah</p>
              </span>
              <span>
                <p>NIM</p>
                <p>000002341720102</p>
              </span>
              <span>
                <p>Alamat Email</p>
                <p>syafiq@gmail.com</p>
              </span>
              <span>
                <p>Nomor Telepon</p>
                <p>081236498238</p>
              </span>
              <span>
                <p>Status</p>
                <p>Mahasiswa</p>
              </span>
            </div>
          </div>
        </div>
        <div class="box-profile">
          <div class="info-personal">
            <h2>Alamat</h2>
            <div class="info-grid">
              <span>
                <p>Negara</p>
                <p>Indonesia</p>
              </span>
              <span>
                <p>Provinsi</p>
                <p>Jawa Timur</p>
              </span>
              <span>
                <p>Kota/Kabupaten</p>
                <p>Trenggalek</p>
              </span>
              <span>
                <p>Kecamatan</p>
                <p>Karangan</p>
              </span>
              <span>
                <p>Desa</p>
                <p>Sumber Dingin</p>
              </span>
              <span>
                <p>Kode Pos</p>
                <p>66123</p>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>