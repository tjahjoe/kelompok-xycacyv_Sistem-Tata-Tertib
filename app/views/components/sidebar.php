<?php
function Sidebar($data)
{
  if (!$data) {
    return;
  }

  $role =  $data['role'] ?? null;
?>
  <div class="sidebar">
    <a href="#profile-user" class="tab-link active">Profil Saya</a>

    <?php if (in_array($role, ['dosen', 'dpa', 'kps', 'sekjur', 'admin'])): ?>
      <a href="#riwayat-pelaporan" class="tab-link">Riwayat Pelaporan</a>
    <?php endif; ?>

    <?php if ($role === 'admin'): ?>
      <a href="#pengaturan-lanjutan" class="tab-link">Pengaturan Lanjutan</a>
    <?php endif; ?>

    <?php if ($role === 'mahasiswa'): ?>
      <a href="#riwayat-pelanggaran" class="tab-link">Riwayat Pelanggaran</a>
    <?php endif; ?>

    <a href="#" class="tab-link logout-btn">Keluar Akun</a>
  </div>
<?php
}
?>