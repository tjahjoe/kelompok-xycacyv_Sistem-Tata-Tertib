<?php 
include 'components/emptyState.php'; 
include 'components/navbar.php'; 
include 'components/table.php'; 
?>
<?php
require_once '../app/controllers/getData.php' ;
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
          <h2>Profil Saya</h2>
          <p>Anda tidak dapat mengubah informasi pribadi di sini. Untuk mengubah informasi, silakan hubungi admin.</p>
        </div>
        <?php include 'components/infoProfile.php'; 

        $user_data = dataUser();
        InfoProfile($user_data);
        ?>
      </div>

      <!-- RIWAYAT PELANGGARAN -->
      <div class="tab-content" id="riwayat-pelanggaran">
        <div class="head-tab-content">
          <h2>Riwayat Pelanggaran</h2>
        </div>
        <?php 
        $dataPelanggaran = dataPelanggaran();

        if($dataPelanggaran){
          TableContent($dataPelanggaran, 'detail-pelanggaran'); 
        }else{
          EmptyState('EmptyState.png', 'Tidak ada riwayat pelanggaran');
        }
        ?>
        
      </div>

      <!-- RIWAYAT PELAPORAN -->
      <div class="tab-content" id="riwayat-pelaporan">
        <div class="head-tab-content">
          <h2>Riwayat Pelaporan</h2>
        </div>
        <?php 
        $dataPelaporan = dataPelapor();
        var_dump($dataPelaporan);
        if($dataPelaporan){
          TableContent($dataPelaporan, 'detail-pelaporan-admin'); 
        }else{
          EmptyState('EmptyStatePelaporan.png', 'Tidak ada riwayat pelaporan');
        }
        ?>
        
      </div>
    </div>
  </div>
  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>