<?php
require_once 'badge.php';

function TableContent($data, $linkDetail)
{
  if (!empty($data)) {
    $columns = array_keys($data[0]);
?>
    <div class="table-container">
      <table class="table-content">
        <thead>
          <tr>
            <?php
            foreach ($columns as $kolom) {
              if ($kolom == 'id') continue;
            ?>
              <th class="capitalize-text"><?php echo $kolom; ?></th>
            <?php } ?>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $record) { ?>
            <tr>
              <?php foreach ($columns as $kolom) {
                if ($kolom == 'id') continue;

                $addedClass = ($kolom == 'JUDUL MASALAH' || $kolom == 'NAMA') ? 'class="text-left truncate"' : '';

                if($kolom == 'TANGGAL'){
                  $timestamp = strtotime($record[$kolom]);

                  $formattedDate = date("d M Y", $timestamp);

                  $record[$kolom] = $formattedDate;
                }
              ?>
                <td <?php echo $addedClass; ?>>
                  <?php echo isset($record[$kolom]) && $kolom == 'STATUS' ? Badge(strtolower($record[$kolom])) : $record[$kolom]; ?>
                </td>
              <?php } ?>
              <td><a href="<?php echo $linkDetail . '.php?id=' . $record['id']; ?>">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
<?php
  } else {
    echo "<p>Data tidak tersedia!</p>";
  }
}
?>