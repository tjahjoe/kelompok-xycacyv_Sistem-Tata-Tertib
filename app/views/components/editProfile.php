<?php
function EditProfile($data)
{
?>
  <?php
  if (!empty($data)) {
  ?>
    <form class="form-container" id="form-editprofile" enctype="multipart/form-data">
      <div class="flex-between m-0">
        <div class="flex-row m-0">
          <?php 
          $photoProfile =  $data['foto_diri'] ? '../assets/uploads/photo/' . $data['foto_diri'] : "../assets/images/foto.webp"; 
          ?>

          <img src="<?php echo $photoProfile ?>" alt="Profile Picture" class="profile-image border-image" id="profile-image" width="100px" height="100px" />
          <div class="flex-row m-0">
            <input type="file" name="photo" id="change-photo" style="display: none;" accept="image/*" />

            <label for="change-photo" class="btn btn-white btn-small">Unggah foto baru</label>
            <label for="" id="delete-photo" class="btn btn-gray btn-small" <?php echo  $data['foto_diri'] ? '' : 'style="display: none;"' ?>>Hapus Foto</label>
          </div>
        </div>

        <div class="flex-row m-0">
          <button class="btn btn-primary" type="submit">Simpan</button>
          <button type="button" class="btn btn-gray" id="back-to-profile">Kembali</button>
        </div>
      </div>

      <!-- Pesan Error -->
      <div id="hasil" style="color: red; display:none"></div>

      <div class="input-editprofile mt-2">
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="<?php echo $data['nama'] ?>" id="nama">
      </div>

      <?php
      $kolomIdUser = array_key_first($data);
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
        <input type="text" name="role" value="<?php echo $data['role'] ?>" class="capitalize-text" id="role" disabled>
      </div>

    </form>
  <?php } else {
    echo "<p>Data is not available</p>";
  } ?>

<?php } ?>