<?php
function KelolaTatib($data) {
?>
<div id="error-tatib" style="color: red; display:none"></div>
  <div class="flex-col">
   <form action="" id="add-tatatertib" class="form-tatib">
      <div class="flex-col">
        <label for="namaPelanggaran">
          <h4>Nama Pelanggaran</h4>
        </label>
        <input type="text" name="namaPelanggaran" class="input-kelola-tatib" id="namaPelanggaran" placeholder="Ketik nama pelanggaran di sini..." required>
      </div>
      <div class="flex-col">
        <label for="tingkatPelanggaran">
          <h4>Tingkat</h4>
        </label>
        <select id="tingkatPelanggaran" class="tingkatPelanggaran input-kelola-tatib" name="tingkatPelanggaran" required>
          <option disabled selected hidden value="">PIlih Tingkat Pelanggaran</option>
          <option value="I">I</option>
          <option value="I/II">I/II</option>
          <option value="II">II</option>
          <option value="III">III</option>
          <option value="IV">IV</option>
          <option value="V">V</option>
        </select>
      </div>
      <button class="btn btn-gray" type="submit"><img src="../assets/images/send.svg" alt=""></button>
    </form>

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
                <td class="icon-tatib">
                  <span>•••</span>
                  <div class="detail-icon-tatib">
                  <div class="flex-col">
                    <span class="update-tatib" data-id="<?php echo $record['id_list_pelanggaran'] ?>">
                      <div class="flex-row">
                        <img src="../assets/images/Edit.svg" alt="" width="20px">
                        <p>Edit</p>
                      </div>
                    </span>
                    <span class="delete-tatib" data-id="<?php echo $record['id_list_pelanggaran'] ?>"> <div class="flex-row">
                        <img src="../assets/images/delete-icon.svg" alt="" width="20px">
                        <p>Delete</p>
                      </div></span>
                  </div>
                </div>
                </td>
              </tr>
          <?php }
          } else {
            echo "<tr><td colspan='4'>Data tidak tersedia!</td></tr>";
          } ?>
        </tbody>
      </table>
    </div>

  </div>
<?php
}
?>