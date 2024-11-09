<?php
function DetailSection($data)
{
?>
  <?php if (!empty($data)) { ?>
    <div class="detail-container">
      <?php foreach ($data as $record) {
        foreach ($record as $kolom => $nilai) { ?>
          <div class="detail-item">
            <h4 class="capitalize-text"><?php echo $kolom ?></h4>
            <p><?php echo $nilai ?></p>
          </div>
      <?php
        }
      }
      ?>
    </div>

    <a href="profile-user.php" class="btn btn-primary">Kembali</a>
    </div>
<?php
  }
}
?>