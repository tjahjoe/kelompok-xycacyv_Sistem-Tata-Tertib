<?php
require_once __DIR__ . "../../../controllers/getData.php";

$data = dataUser();
?>
<div class="sidebar">
  <a href="#profile-user" class="tab-link active">Profil Saya</a>
  <?php
  if ($data && in_array($data['role'], ['dosen', 'dpa', 'kps', 'sekjur', 'admin'])) {
  ?>
    <a href="#riwayat-pelaporan" class="tab-link">Riwayat Pelaporan</a>
    <a href="#pengaturan-lanjutan" class="tab-link">Pengaturan Lanjutan</a>
  <?php } else { ?>
    <a href="#riwayat-pelanggaran" class="tab-link">Riwayat Pelanggaran</a>
  <?php } ?>
  <a href="#" class="tab-link logout-btn">Keluar Akun</a>
</div>