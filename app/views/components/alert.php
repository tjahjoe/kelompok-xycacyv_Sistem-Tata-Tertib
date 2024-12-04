<?php
function Alert($icon, $information, $title, $isAlertConfirmation, $id)
{ ?>
  <div class="overlay" id="<?php echo $id; ?>">
    <div class="alert-box">
      <div class="alert-icon"><img src="../assets/images/<?php echo $icon; ?>" alt=""></div>
      <div class="alert-title"><?php echo $information; ?></div>
      <?php if($title != '') { ?>
      <div class="alert-message">
        <?php echo $title; ?><br>
      </div>
      <?php }?>
      <?php if(!$isAlertConfirmation){?>

        <button class="btn btn-primary alert-close-button" data-alert-id="<?php echo $id; ?>">Kembali</button>

      <?php }else{?>
      <div class="flex-row">
        <button class="btn btn-primary alert-confirm-button" data-alert-id="<?php echo $id; ?>">Konfirmasi</button>
        <button class="btn btn-white alert-close-button" data-alert-id="<?php echo $id; ?>">Kembali</button>
      </div>
      <?php }?>
    </div>
  </div>
<?php } ?>
