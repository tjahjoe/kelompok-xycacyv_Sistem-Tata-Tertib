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

  <form class="form-container" id="form-editprofile" enctype="multipart/form-data">
    <div class="flex-between">
      <div class="flex-row m-0">
        <img src="../assets/images/<?php echo $data['foto_diri'] ?>" alt="Profile Picture" class="profile-image border-image" id="profile-image" width="100px" height="100px"/>
      <div class="flex-row m-0">
        <input type="file" name="photo" id="change-photo" style="display: none;" />

        <label for="change-photo" class="btn btn-white btn-small">Unggah foto baru</label>
        <label for="" id="delete-photo" class="btn btn-gray btn-small">Hapus Foto</label>
      </div>
      </div>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
    
    <div class="input-editprofile mt-2">
      <label for="nama">Nama</label>
      <input type="text" name="nama" value="<?php echo $data['nama'] ?>" id="nama">
    </div>

    <?php
            // Mendapatkan nama kolom pertama (key pertama)
            $kolomIdUser = array_key_first($data);
            // Mengambil nilai berdasarkan key tersebut
            $idUser = $data[$kolomIdUser];
            ?>
    <div class="input-editprofile uppercase-text">
      <label for="id-user"><?php echo $kolomIdUser; ?></label>
      <input type="text" name="id-user" value="<?php echo $idUser; ?>" id="id-user" disabled>
    </div>
    <div class="input-editprofile">
      <label for="notelp">Nomor Telepon</label>
      <input type="text" name="notelp" value="<?php echo $data['notelp']; ?>" id="notelp">
    </div>
    <div class="input-editprofile">
      <label for="role">Pekerjaan</label>
      <input type="text" name="role" value="<?php echo $data['role'] ?>" id="role" disabled>
    </div>

  </form>
</div>


  <script src="../assets/js/script.js"></script>
</body>

</html>