<?php function Alert($icon, $information, $title, $content)
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
        Anda akan diarahkan ke beranda
      </div>
      <button class="btn btn-primary alert-close-button">Kembali</button>
    </div>
  </div>
<?php } ?>