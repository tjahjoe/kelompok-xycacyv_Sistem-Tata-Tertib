<?php
  function TataTertibSection($data){
?>
<section id="tataTertib">
  <h1 class="title">Tata Tertib Mahasiswa<br> Jurusan Teknik Informatika</h1>
  <div class="table-container">
    <table id="tataTertib">
      <thead>
        <tr>
          <th>No</th>
          <th>Pelanggaran</th>
          <th>Tingkat</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($data)){?>
        <?php foreach($data as $record){?>
        <tr>
          <td><?php echo$record['id_list_pelanggaran']?></td>
          <td><?php echo$record['nama_jenis_pelanggaran']?></td>
          <td><?php echo$record['tingkat_pelanggaran']?></td>
        </tr>
        <?php } }?>
        <!-- <tr>
          <td>1</td>
          <td>Tidak melakukan tindakan kriminal dan asusila termasuk membawa senjata tajam dan senapan, membawa atau menggunakan NAPZA, dan membawa barang-barang porno</td>
          <td>IV</td>
        </tr> -->
        <!-- <tr>
          <td>2</td>
          <td>Memakai pakaian yang rapi, bersepatu, atau bersepatu sandal</td>
          <td>IV</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Setiap orang dalam melakukan aktivitas membutuhkan kenyamanan dan ketertiban. Begitu pula dengan aktivitas perkuliahan. Perkuliahan dapat berjalan dengan aman, tertib, dan lancar bila semua</td>
          <td>IV</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Memakai pakaian yang rapi, bersepatu, atau bersepatu sandal</td>
          <td>IV</td>
        </tr>
        <tr>
          <td>5</td>
          <td>Memakai pakaian yang rapi, bersepatu, atau bersepatu sandal</td>
          <td>IV</td>
        </tr>
        <tr>
          <td>6</td>
          <td>Setiap orang dalam melakukan aktivitas membutuhkan kenyamanan dan ketertiban. Begitu pula dengan aktivitas perkuliahan. Perkuliahan dapat berjalan dengan aman, tertib, dan lancar bila semua</td>
          <td>IV</td>
        </tr>
        <tr>
          <td>7</td>
          <td>Tidak melakukan tindakan kriminal...</td>
          <td>IV</td>
        </tr>
        <tr>
          <td>8</td>
          <td>Setiap orang dalam melakukan aktivitas membutuhkan kenyamanan dan ketertiban. Begitu pula dengan aktivitas perkuliahan. Perkuliahan dapat berjalan dengan aman, tertib, dan lancar bila semua</td>
          <td>IV</td>
        </tr>
        <tr>
          <td>9</td>
          <td>Tidak melakukan tindakan kriminal...</td>
          <td>IV</td>
        </tr> -->
      </tbody>
    </table>
  </div>
</section>
<?php }?>