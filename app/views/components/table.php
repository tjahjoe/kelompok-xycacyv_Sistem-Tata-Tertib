<?php
// Fungsi ini menampilkan semua kolom yang ada dalam data secara otomatis.
function TableContent($data)
{
  if (!empty($data)) {
    // Ambil nama kolom dari elemen pertama data
    $columns = array_keys($data[0]);
    ?>
    <div class="table-container">
      <table class="table-content">
        <thead>
          <tr>
            <?php foreach ($columns as $kolom) { ?>
              <th class="capitalize-text"><?php echo $kolom; ?></th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $index => $record) { ?>
            <tr>
              <td><?php echo $index + 1; ?></td>
              <?php foreach ($columns as $kolom) { ?>
                <td><?php echo isset($record[$kolom]) ? $record[$kolom] : '-'; ?></td>
              <?php } ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php
  } else {
    echo "<p>No data available.</p>";
  }
}
?>
