<?php
function TataTertibSection($data)
{
?>
  <section id="tataTertib">
    <h1 class="title">Tata Tertib Mahasiswa<br> Jurusan Teknik Informatika</h1>
    <div class="filter-tingkat-pelanggaran">
      <h4>Filter by tingkat:</h4>
      <select id="tingkatPelanggaran" class="tingkatPelanggaran" name="tingkatPelanggaran">
        <option value="">All</option>
        <option value="I">Tingkat I</option>
        <option value="I/II">Tingkat I/II</option>
        <option value="II">Tingkat II</option>
        <option value="III">Tingkat III</option>
        <option value="IV">Tingkat IV</option>
        <option value="V">Tingkat V</option>
      </select>
    </div>
    <div class="table-container square-border mt-2">
      <table id="tataTertib" class="m-0">
        <thead>
          <tr>
            <th width="100px">No</th>
            <th>Pelanggaran</th>
            <th width="100px">Tingkat</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($data)) {
            $index = 0;
          ?>
            <?php foreach ($data as $record) {
              $index++;
            ?>
              <tr>
                <td><?php echo $index ?></td>
                <td><?php echo $record['nama_jenis_pelanggaran'] ?></td>
                <td><?php echo $record['tingkat_pelanggaran'] ?></td>
              </tr>
          <?php }
          } else {
            echo "<tr><td colspan='3'>No data available</td></tr>";
          } ?>
        </tbody>
      </table>
    </div>
  </section>
<?php } ?>