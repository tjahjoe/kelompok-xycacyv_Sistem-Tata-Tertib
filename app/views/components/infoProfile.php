<?php
function InfoProfile($data)
{
?>
  <?php if (!empty($data)) { ?>
    <div class="box-profile">
      <div class="info-user">
        <img src="../assets/uploads/photo/<?php echo $data['foto_diri'] ?>" alt="Profile Picture" class="profile-image" width="80px" height="80px"/>
        <span>
          <h3 class="capitalize-text"><?php echo $data['nama'] ?></h3>
          <p class="capitalize-text"><?php echo $data['role'] ?></p>
        </span>
      </div>
    </div>
    <div class="box-profile">
      <div class="info-personal">
        <h2>Informasi Pribadi</h2>
        <div class="info-grid">
          <span class="capitalize-text">
            <p>Nama Awal</p>
            <p><?php echo $data['nama_awal']; ?></p>
          </span>
          <span class="capitalize-text">
            <p>Nama Akhir</p>
            <p><?php echo $data['nama_akhir']; ?></p>
          </span>
          <span>
            <?php
            // Mendapatkan nama kolom pertama (key pertama)
            $kolomIdUser = array_key_first($data);
            // Mengambil nilai berdasarkan key tersebut
            $idUser = $data[$kolomIdUser];
            ?>
            <p class="uppercase-text"><?php echo $kolomIdUser; ?></p>
            <p><?php echo $idUser; ?></p>
          </span>
          <span>
            <p class="capitalize-text">Nomor Telepon</p>
            <p><?php echo $data['notelp']; ?></p>
          </span>
          <span>
            <p class="capitalize-text">Email</p>
            <p><?php echo $data['email']; ?></p>
          </span>
          <span>
            <p class="capitalize-text">Pekerjaan</p>
            <p><?php echo $data['role']; ?></p>
          </span>
        </div>
      </div>

      <a href="edit-profile.php">
        <img class="edit-icon" src="../assets/images/Edit.svg" alt="edit icon" width="35px">
      </a>
    </div>
<?php
  }
  else{
    echo "<p style='margin:20px auto; '>Data is not available</p>";
  }
}
?>