<?php
require_once 'badge.php';

function DetailSection($data)
{
    if (!empty($data)) { ?>
        <div class="detail-container">
            <?php foreach ($data as $kolom => $nilai) {
                if ($kolom == 'id') continue;
            ?>
                <div class="detail-item">
                    <h4 class="capitalize-text"><?php echo $kolom; ?></h4>
                    <?php if ($kolom == 'Status') {
                        echo Badge(strtolower($nilai));
                    } else if ($kolom == 'Bukti') {
                        echo "<div class='flex-row-start'>";
                        foreach ($nilai as $image) {
                            echo "<img src='../assets/uploads/bukti/$image' class='lampiran_bukti' alt='Bukti' width='200px'>";
                        }
                        echo "</div>";
                    } else { ?>
                        <p><?php echo $nilai; ?></p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
         <!-- modal box foto -->
  <div class="overlay">
    <div class="alert-box">
      <img src='../assets/uploads/bukti/560.jpg' class='lampiran_bukti_full' alt='Bukti'>
    </div>
  </div>

<?php
    } else {    
        echo "<p style='margin:20px auto; '>Data is not available</p>";
    }
}
?>