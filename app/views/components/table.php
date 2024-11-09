<?php
// columnsToShow = menyimpan nama kolom yang ingin ditampilkan
function TableContent($data, $columnsToShow = [])
{
?>
  <?php if (!empty($data)) { ?>
    <div class="table-container">
      <table class="table-content">
        <thead>
          <tr>
            <th>No</th>
            <?php
            foreach ($columnsToShow as $kolom) { ?>
              <th class="capitalize-text"><?php echo $kolom; ?></th>
            <?php } ?>
          </tr>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $index => $record) { ?>
          <tr>
            <td><?php echo $index + 1; ?></td>
            <?php
            // Tampilkan data hanya pada kolom yang dipilih di $columnsToShow
            foreach ($columnsToShow as $kolom) { ?>
              <td><?php echo isset($record[$kolom]) ? $record[$kolom] : '-'; ?></td>
            <?php } ?>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
<?php
  }
}
?>