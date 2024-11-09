<?php include 'badge.php'; ?>

<div class="table-container">
  <table class="table-content">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Judul Masalah</th>
        <th>Catatan</th>
        <th>Tingkat</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>21/05/2024</td>
        <td>Lorem ipsum Judul Masalah berada disini. Lorem ipsum lorem ipsum</td>
        <td>Lorem ipsum. Terdapat...</td>
        <td>I</td>
        <td><?php Badge('baru')?></td>
        <td><a href="detail-pelaporan.php" class="link-detail">Detail</a></td>
      </tr>
      <tr>
        <td>2</td>
        <td>21/05/2024</td>
        <td>Lorem ipsum odor amet, consectetuer</td>
        <td>-</td>
        <td>IV</td>
        <td><?php Badge('aktif')?></td>
        <td><a href="detail-pelaporan.php" class="link-detail">Detail</a></td>
      </tr>
      <tr>
        <td>3</td>
        <td>21/05/2024</td>
        <td>Lorem ipsum odor amet, consectetuer</td>
        <td>-</td>
        <td>IV</td>
        <td><?php Badge('nonaktif')?></td>
        <td><a href="detail-pelaporan.php" class="link-detail">Detail</a></td>
      </tr>
      <tr>
        <td>4</td>
        <td>21/05/2024</td>
        <td>Lorem ipsum odor amet, consectetuer</td>
        <td>-</td>
        <td>IV</td>
        <td><?php Badge('reject')?></td>
        <td><a href="detail-pelaporan.php" class="link-detail">Detail</a></td>
      </tr>
    </tbody>
  </table>
</div>
