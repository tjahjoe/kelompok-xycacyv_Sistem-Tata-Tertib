<?php
require_once __DIR__ . "../../../controllers/getData.php";

function FormUser($data, $type)
{
  $dataDpa = dataDpa();
?>
  <?php
  if ($type == 'edit-user') {
    if (!empty($data)) {
      $nama = $data['nama'];
      $notelp = $data['notelp'];
      $email = $data['email'];
      $role = $data['role'];
      $status = $data['status'];
      $photoProfile =  $data['foto_diri'] ? '../assets/uploads/photo/' . $data['foto_diri'] : "../assets/images/foto.webp";

  ?>
      <form class="form-container" id="form-edit-user" enctype="multipart/form-data">
        <div class="flex-between m-0">
          <div class="flex-row m-0">
            <img src="<?php echo $photoProfile ?>" alt="Profile Picture" class="profile-image border-image" id="profile-image" width="100px" height="100px" />
            <div class="flex-row m-0">
              <label for="" id="delete-photo" class="btn btn-gray btn-small" <?php echo $data['foto_diri'] ? '' : 'style="display: none;"' ?>>Hapus Foto</label>
            </div>
          </div>

          <div class="flex-row m-0">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a href="profile-user.php#pengaturan-lanjutan" class="btn btn-gray">Kembali</a>
          </div>
        </div>

        <!-- Pesan Error -->
        <div id="hasil" style="color: red; display:none"></div>

        <div class="detail-container">
          <div class="detail-item">
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="<?php echo $nama; ?>" id="nama">
          </div>

          <?php
          $kolomIdUser = array_key_first($data);
          $idUser = $data[$kolomIdUser];
          ?>
          <div class="detail-item uppercase-text">
            <label for="id"><?php echo $kolomIdUser; ?></label>
            <input type="hidden" name="id" value="<?php echo $idUser; ?>">
            <input type="text" name="id-user" value="<?php echo $idUser; ?>" id="id-user" disabled>
          </div>
          <div class="detail-item">
            <label for="notelp">Nomor Telepon</label>
            <input type="text" name="notelp" value="<?php echo $notelp; ?>" id="notelp">
          </div>
          <div class="detail-item">
            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>" id="email">
          </div>
          <div class="detail-item">
            <label for="role">Pekerjaan</label>
            <?php if ($role == 'mahasiswa') { ?>
              <input type="text" name="roleDis" value="<?php echo $role ?>" class="capitalize-text" id="role" disabled>
              <input type="hidden" name="role" value="<?php echo $role ?>">
            <?php } else { ?>
              <input type="hidden" name="roleAwal" value="<?php echo $role ?>">
              <select name="roleAkhir" class="capitalize-text" id="role">
                <option value="admin" <?php echo ($role === 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="dosen" <?php echo ($role === 'dosen') ? 'selected' : ''; ?>>Dosen</option>
                <option value="dpa" <?php echo ($role === 'dpa') ? 'selected' : ''; ?>>DPA</option>
                <option value="kps" <?php echo ($role === 'kps') ? 'selected' : ''; ?>>KPS</option>
                <option value="sekjur" <?php echo ($role === 'sekjur') ? 'selected' : ''; ?>>Sekjur</option>
              </select>
            <?php } ?>
          </div>
          <?php if ($role == 'mahasiswa') { ?>
            <div class="detail-item">
              <label for="dpa">DPA</label>
              <select name="dpa" id="dpa" class="capitalize-text">
                <?php
                if (!empty($dataDpa)) {
                  $isDpaExist = false;
                  foreach ($dataDpa as $dpa) {
                    $selected = ($data['nip'] == $dpa['nip']) ? 'selected' : '';

                    echo "<option value='{$dpa['nip']}' $selected>{$dpa['nip']} - {$dpa['nama_dosen']}</option>";
                    if($selected){
                      $isDpaExist = true;
                    }
                  }
                  if(!$isDpaExist){
                    echo "<option disabled selected hidden>Pilih DPA</option>";
                  }
                } else {
                  echo "<option disabled selected hidden>Tidak ada DPA!</option>";
                }
                ?>
              </select>
            </div>
            <div class="detail-item">
              <label for="notelpOrtu">Nomor Telepon Orang Tua</label>
              <input type="text" name="notelpOrtu" value="<?php echo $data['notelp_ortu']; ?>" id="notelpOrtu">
            </div>
            <div class="detail-item">
              <label for="namaOrtu">Nama Orang Tua</label>
              <input type="text" name="namaOrtu" value="<?php echo $data['nama_ortu']; ?>" id="namaOrtu">
            </div>
          <?php } ?>
          <div class="detail-item">
            <label for="status">Status</label>
            <select name="status" class="capitalize-text" id="status">
              <option value="aktif" <?php echo ($status === 'aktif') ? 'selected' : ''; ?>>Aktif</option>
              <option value="nonaktif" <?php echo ($status === 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
            </select>
          </div>
        </div>

      </form>
  <?php } else {
      echo "<p>Data tidak ditemukan!</p>";
    }
  } ?>

  <?php
  if ($type == 'add-user') {
  ?>
    <form class="form-container" id="form-add-user" enctype="multipart/form-data">
      <div class="flex-between mt-2">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="profile-user.php#pengaturan-lanjutan" class="btn btn-gray">Kembali</a>
      </div>

      <!-- Pesan Error -->
      <div id="hasil" style="color: red; display: none;"></div>

      <div class="detail-container">
        <div class="detail-item">
          <label for="nama">Nama</label>
          <input type="text" name="nama" value="" id="nama" placeholder="Masukkan nama" required/>
        </div>

        <div class="detail-item uppercase-text">
          <label for="id">ID</label>
          <input type="text" name="id" value="" id="id" placeholder="Masukkan id" required/>
        </div>
        <div class="detail-item">
          <label for="notelp">Nomor Telepon</label>
          <input type="text" name="notelp" value="" id="notelp" placeholder="Masukkan nomor telepon" required/>
        </div>
        <div class="detail-item">
          <label for="email">Email</label>
          <input type="text" name="email" value="" id="email" placeholder="Masukkan email" required/>
        </div>
        <div class="detail-item">
          <label for="role">Pekerjaan</label>
          <select name="role" class="capitalize-text" id="add-role" required>
            <option disabled selected hidden>Pilih Role</option>
            <option value="admin">Admin</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
            <option value="dpa">DPA</option>
            <option value="kps">KPS</option>
            <option value="sekjur">Sekjur</option>
          </select>
        </div>
        <div class="detail-item" id="select-dpa" style="display:none">
          <label for="dpa">DPA</label>
          <select name="dpa" id="dpa" class="capitalize-text" required>
            <option disabled selected hidden>Pilih DPA</option>
            <?php
            if (!empty($dataDpa)) {
              foreach ($dataDpa as $dpa) {
                echo "<option value='{$dpa['nip']}'>{$dpa['nip']} - {$dpa['nama_dosen']}</option>";
              }
            } else {
              echo "<option disabled>Tidak ada data DPA</option>";
            }
            ?>
          </select>
        </div>
      </div>
    </form>
  <?php
  }
  ?>

<?php } ?>