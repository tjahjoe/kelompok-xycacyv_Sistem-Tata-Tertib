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
      <select id="tingkatPelanggaran" class="tingkatPelanggaran" ame="tingkatPelanggaran">
        <option value="">All</option>
      <option value="I">1</option>
      <option value="II">2</option>
      <option value="III">3</option>
      <option value="IV">4</option>
      <option value="V">5</option>
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