<?php
require_once __DIR__ . "../../../controllers/getData.php";
?>

<?php
function KelolaTatib()
{
?>
  <div class="flex-col">
    <form action="" id="add-tatatertib" class="form-add-tatib">
      <div class="flex-col">
        <label for="namaPelanggaran">
          <h4>Nama Pelanggaran</h4>
        </label>
        <input type="text" name="namaPelanggaran" class="input-kelola-tatib" id="namaPelanggaran" placeholder="Ketik nama pelanggaran di sini...">
      </div>
      <div class="flex-col">
        <label for="tingkatPelanggaran">
          <h4>Tingkat</h4>
        </label>
        <select id="tingkatPelanggaran" class="tingkatPelanggaran input-kelola-tatib" name="tingkatPelanggaran" required>
          <option disabled selected hidden>PIlih Tingkat Pelanggaran</option>
          <option value="I">I</option>
          <option value="I/II">I/II</option>
          <option value="II">II</option>
          <option value="III">III</option>
          <option value="IV">IV</option>
          <option value="V">V</option>
        </select>
        <!-- <input type="text" name="tingkatPelanggaran" class="input-kelola-tatib" id="tingkatPelanggaran"> -->
      </div>
      <button class="btn btn-gray" type="submit"><img src="../assets/images/send.svg" alt=""></button>
    </form>

    <?php
    $data = ListPelanggaran();
    // var_dump($data);
    ?>

    <div id="hasil" style="color: red; display:none"></div>
    <div class="table-container">
      <table class="table-content">
        <thead>
          <tr>
            <th>NO</th>
            <th>PELANGGARAN</th>
            <th>TINGKAT</th>
            <th>OPSI</th>
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
                <td class="text-left normal-white-space"><?php echo $record['nama_jenis_pelanggaran'] ?></td>
                <td><?php echo $record['tingkat_pelanggaran'] ?></td>
                <td><span id="update-tatib" data-id="<?php echo $record['id_list_pelanggaran'] ?>">•••</span></td>
              </tr>
          <?php }
          } else {
            echo "<tr><td colspan='4'>No data available</td></tr>";
          } ?>
        </tbody>
      </table>
    </div>

  </div>
<?php
}
?>