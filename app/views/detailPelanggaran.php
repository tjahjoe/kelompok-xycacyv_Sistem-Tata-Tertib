<?php include 'components/emptyState.php'; ?>
<?php include 'components/detailSection.php'; ?>
<?php
require_once '../app/controllers/getData.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detail Pelanggaran</title>
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php include 'components/navbar.php'; ?>
  <?php Navbar(true); ?>

  <?php
  $data = detailPelanggaran($_GET['id']);
  ?>

  <div class="container pt-5">
    <h1 class="title">Detail Pelanggaran</h1>
    <p><strong>ID Pelanggaran:</strong> <?php echo $data['id'] ?></p>
    <?php
    if (!empty($data)) {
    ?>
      <div class="info-box">
        <span>Informasi</label>
          <p>Untuk menebus sanksi atas pelanggaran, silakan hubungi admin untuk informasi lebih lanjut.</p>
      </div>
    <?php
    } 
    DetailSection($data);
   ?>
   <?php if(!empty($data['Tingkat Pelanggaran']) &&  in_array($data['Tingkat Pelanggaran'], ['III', 'IV', 'V'])){ ?>
    <div class="danger-box">
      <label for="">Lampiran</label>
      <p>Untuk pelanggaran tingkat III hingga V, Anda dapat mengunduh <a href="#" style="text-decoration: underline; color:var(--red-color);">file template di sini.</a></p>
    </div>
    <?php }?>
    
    <a href="profile-user.php" class="btn btn-primary">Kembali</a>
  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>