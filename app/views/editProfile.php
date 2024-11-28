<?php include 'components/navbar.php'; ?>
<?php
require_once '../app/controllers/getData.php';
?>

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
  <?php Navbar(true); ?>
  <div class="container pt-5">
    <div class="flex-between">
      <div class="flex-col">
        <h1 class="title">Perbarui Informasi Pribadi</h1>
        <p class="text-gray">Di sini Anda dapat mengubah informasi pribadi Anda. Setelah selesai, tekan tombol 'Simpan'.</p>
      </div>
    </div>
    
    <?php 
        $data = dataUser();
    ?>

    <div class="flex-between">
      <div class="flex-row m-0">
        <img src="../assets/images/<?php echo $data['foto_diri'] ?>" alt="Profile Picture" class="profile-image border-image" width="100px" height="100px"/>
      <div class="flex-row m-0">

        <label for="change-photo" class="btn btn-white btn-small">Unggah foto baru</label>
        <label for="delete-photo" class="btn btn-gray btn-small">Hapus Foto</label>
      </div>
      </div>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
  </div>
  <script src="../assets/js/script.js"></script>
</body>

</html>