<?php
function FormUser($data, $type)
{
?>
  <?php
  if ($type == 'edit-user') {
    if(!empty($data)){
  ?>
    <form class="form-container" id="form-edit<?= $data['role'] ?>" enctype="multipart/form-data">
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
          <a href="profile-user.php" class="btn btn-gray">Kembali</a>
        </div>
      </div>

      <!-- Pesan Error -->
      <div id="hasil" style="color: red; display:none"></div>

      <div class="detail-container">
        <div class="detail-item">
          <label for="nama">Nama</label>
          <input type="text" name="nama" value="<?php echo $data['nama'] ?>" id="nama">
        </div>

        <?php
        $kolomIdUser = array_key_first($data);
        $idUser = $data[$kolomIdUser];
        ?>
        <div class="detail-item uppercase-text">
          <label for="id-user"><?php echo $kolomIdUser; ?></label>
          <input type="text" name="id-user" value="<?php echo $idUser; ?>" id="id-user">
        </div>
        <div class="detail-item">
          <label for="notelp">Nomor Telepon</label>
          <input type="text" name="notelp" value="<?php echo $data['notelp']; ?>" id="notelp">
        </div>
        <div class="detail-item">
          <label for="email">Email</label>
          <input type="text" name="email" value="<?php echo $data['email']; ?>" id="email">
        </div>
        <div class="detail-item">
          <label for="role">Pekerjaan</label>
          <?php if ($data['role'] == 'mahasiswa') { ?>
            <input type="text" name="role" value="<?php echo $data['role'] ?>" class="capitalize-text" id="role" disabled>
          <?php } else { ?>
            <select name="role" class="capitalize-text" id="role">
              <option value="admin" <?php echo ($data['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
              <option value="dosen" <?php echo ($data['role'] === 'dosen') ? 'selected' : ''; ?>>Dosen</option>
              <option value="dpa" <?php echo ($data['role'] === 'dpa') ? 'selected' : ''; ?>>DPA</option>
              <option value="kps" <?php echo ($data['role'] === 'kps') ? 'selected' : ''; ?>>KPS</option>
              <option value="sekjur" <?php echo ($data['role'] === 'sekjur') ? 'selected' : ''; ?>>Sekjur</option>
            </select>
          <?php } ?>
        </div>
        <?php if ($data['role'] == 'mahasiswa') { ?>
          <div class="detail-item">
            <label for="dpa">DPA</label>
            <select name="dpa" id="dpa">
              <option value="1" <?php //echo ($data['dpa'] === 'aktif') ? 'selected' : ''; 
                                ?>>1</option>
            </select>
          </div>
        <?php } ?>
        <div class="detail-item">
          <label for="status">Status</label>
          <select name="status" class="capitalize-text" id="status">
            <option value="aktif" <?php echo ($data['status'] === 'aktif') ? 'selected' : ''; ?>>Aktif</option>
            <option value="nonaktif" <?php echo ($data['status'] === 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
          </select>
        </div>
      </div>

    </form>
  <?php } else{
    echo "<p>Data tidak ditemukan!</p>";
  }} ?>

  <?php
  if ($type == 'add-user') {
  ?>
    <form class="form-container" id="form-add-user" enctype="multipart/form-data">
      <div class="flex-between m-0">
        <div class="flex-row m-0">
          <img
            src="../assets/images/foto.webp"
            alt="Profile Picture"
            class="profile-image border-image"
            id="profile-image"
            width="100px"
            height="100px" />
          <div class="flex-row m-0">
            <input
              type="file"
              name="photo"
              id="change-photo"
              style="display: none;"
              accept="image/*" />
            <label for="change-photo" class="btn btn-white btn-small">Unggah foto baru</label>
            <label for="" id="delete-photo" class="btn btn-gray btn-small" style="display: none;">Hapus Foto</label>
          </div>
        </div>

        <div class="flex-row m-0">
          <button class="btn btn-primary" type="submit">Simpan</button>
          <a href="profile-user.php" class="btn btn-gray">Kembali</a>
        </div>
      </div>

      <!-- Pesan Error -->
      <div id="hasil" style="color: red; display: none;"></div>

      <div class="detail-container">
        <div class="detail-item">
          <label for="nama">Nama</label>
          <input type="text" name="nama" value="" id="nama" placeholder="Masukkan nama"/>
        </div>

        <div class="detail-item uppercase-text">
          <label for="id-user">ID</label>
          <input type="text" name="id-user" value="" id="id-user" placeholder="Masukkan id"/>
        </div>
        <div class="detail-item">
          <label for="notelp">Nomor Telepon</label>
          <input type="text" name="notelp" value="" id="notelp" placeholder="Masukkan nomor telepon"/>
        </div>
        <div class="detail-item">
          <label for="email">Email</label>
          <input type="text" name="email" value="" id="email" placeholder="Masukkan email"/>
        </div>
        <div class="detail-item">
          <label for="role">Pekerjaan</label>
          <select name="role" class="capitalize-text" id="add-role">
            <option disabled selected hidden>Pilih Role</option>
            <option value="admin">Admin</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
            <option value="dpa">DPA</option>
            <option value="kps">KPS</option>
            <option value="sekjur">Sekjur</option>
          </select>
        </div>
        <div class="detail-item">
          <label for="notelpOrtu">Nomor Telepon Orang Tua</label>
          <input type="text" name="notelpOrtu" value="" id="notelpOrtu" placeholder="Masukkan nomor telepon"/>
        </div>
          <!-- <div class="detail-item">
            <label for="dpa">DPA</label>
            <select name="dpa" id="dpa">
              <option value="1">1</option>
            </select>
          </div> -->
      </div>
    </form>
  <?php
  }
  ?>

<?php } ?>