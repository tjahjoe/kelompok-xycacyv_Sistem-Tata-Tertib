<?php
require_once 'badge.php';

function TableContent($data, $linkDetail)
{
  if (!empty($data)) {
    // Ambil nama kolom dari elemen pertama data
    $columns = array_keys($data[0]);
    ?>
    <div class="table-container">
      <table class="table-content">
        <thead>
          <tr>
            <?php 
            foreach ($columns as $kolom) { 
              if($kolom == 'id') continue;
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
              // jika kolom = id maka hidden
              if($kolom == 'id') continue;

              // jika kolom = judulmasalah/nama tambah class text-left & truncate
              $addedClass = ($kolom == 'JUDUL MASALAH' || $kolom == 'NAMA') ? 'class="text-left truncate"' : '';
                ?>
                <td 
                <?php 
                echo $addedClass;?> >
                  <?php echo isset($record[$kolom]) && $kolom != 'STATUS' ? $record[$kolom] : Badge(strtolower($record[$kolom])); ?>
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
    echo "<p>No data available.</p>";
  }
}
?>
