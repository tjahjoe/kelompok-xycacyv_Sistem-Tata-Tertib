<?php
function InfoProfile($data)
{
?>
  <?php if (isset($data)) { ?>
    <div class="box-profile">
      <div class="info-user">
        <img src="https://i.pinimg.com/474x/aa/d3/d6/aad3d691d8d8592bb8dd240de636f6a9.jpg" alt="Profile Picture" class="profile-image" />
        <span>
          <h3><?php echo $data['nama_mahasiswa'] ?></h3>
          <p><?php echo $_SESSION['role'] ?></p>
        </span>
      </div>
    </div>
    <div class="box-profile">
      <div class="info-personal">
        <h2>Informasi Pribadi</h2>
        <div class="info-grid">
          <?php foreach ($data as $record) {
            foreach ($record as $kolom => $nilai) { ?>
              <span>
                <p class="capitalize-text"><?php echo $kolom ?></p>
                <p><?php echo $nilai ?></p>
              </span>
          <?php
            }
          } ?>
        </div>
      </div>
    </div>
<?php
  }
} ?>
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