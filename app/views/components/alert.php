<?php function Alert($icon, $information, $title, $content, $isAlertConfirmation)
{ ?>
  <div class="overlay">
    <div class="alert-box">
      <div class="alert-icon"><img src="../assets/images/<?php echo $icon; ?>" alt=""></div>
      <div class="alert-title"><?php echo $information; ?></div>
      <div class="alert-message">
        <strong>
        <?php echo $title; ?><br>
        <?php echo $content; ?><br>
        </strong>
      </div>
      <?php if(!$isAlertConfirmation){?>

        <button class="btn btn-primary alert-close-button" style="margin: 10px auto;">Kembali</button>

      <?php }else{?>
      <div class="flex-row">
        <button class="btn btn-red alert-logout-button">Konfirmasi</button>
        <button class="btn btn-white alert-close-button">Kembali</button>
      </div>
      <?php }?>
    </div>
  </div>
<?php } ?>