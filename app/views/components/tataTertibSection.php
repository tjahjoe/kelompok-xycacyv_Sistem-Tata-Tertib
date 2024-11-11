<?php
require_once __DIR__ . "../../../models/ListPelanggaran.php";
?>

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
        <option value="I">I</option>
        <option value="I/II">I/II</option>
        <option value="II">II</option>
        <option value="III">III</option>
        <option value="IV">IV</option>
        <option value="V">V</option>
      </select>
    </div>
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
          } ?>
        </tbody>
      </table>
    </div>
  </section>
<?php } ?>