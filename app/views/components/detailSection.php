<?php
require_once 'badge.php';
require_once 'buktiBox.php';

function DetailSection($data)
{
  if (!empty($data)) { ?>
    <div class="detail-container">
      <?php 
      foreach ($data as $kolom => $nilai) {
        if ($kolom == 'id') continue; ?>
        
        <div class="detail-item">
          <h4 class="capitalize-text"><?php echo $kolom; ?></h4>
          <?php 
          if ($kolom == 'Status') {
            echo Badge(strtolower($nilai));
          } elseif ($kolom == 'Bukti') {
            echo "<div class='flex-row-start'>";
            $totalFileNotFound = 0;

            if ($nilai) {
              foreach ($nilai as $image) {
                $filePath = "../assets/uploads/bukti/$image";

                if (file_exists($filePath)) {
                  echo "<img src='$filePath' class='lampiran_bukti' alt='Bukti' width='200px'>";
                } else {
                  $totalFileNotFound++;
                }
              }

              if ($totalFileNotFound > 0) {
                echo "<p>Beberapa bukti tidak ditemukan!</p>";
              }
            } else {
              echo "<p>Bukti tidak ada!</p>";
            }

            echo "</div>";
          } else { ?>
            <p class="<?php echo $kolom; ?>"><?php echo $nilai; ?></p>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
    
    <?php BuktiBox(); ?>
  <?php 
  } else {
    echo "<p style='margin:20px auto;'>Data is not available</p>";
  }
}
?>
