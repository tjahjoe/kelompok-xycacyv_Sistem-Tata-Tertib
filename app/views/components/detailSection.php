<?php
require_once 'badge.php';

function DetailSection($data)
{
    if (!empty($data)) { ?>
        <div class="detail-container">
            <?php foreach ($data as $kolom => $nilai) { 
              if($kolom == 'id') continue;
              ?>
                <div class="detail-item">
                    <h4 class="capitalize-text"><?php echo $kolom; ?></h4>
                    <?php if($kolom == 'Status') { 
                      echo Badge(strtolower($nilai));  
                    }else{?>
                    <p><?php echo $nilai; ?></p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php 
    } else { 
        echo "<p style='margin:20px auto; '>Data is not available</p>";
    }
}
?>
