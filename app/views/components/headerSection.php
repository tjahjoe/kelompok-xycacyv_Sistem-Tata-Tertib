<?php
function HeaderSection($title, $paragraph, $showButton) {
?>
<section id="header">
  <div class="box-header">
    <h1 class="main-header">
      <?php echo $title?>
    </h1>
    <p>
      <?php echo $paragraph?>
    </p>

    <?php echo $showButton ? " 
    <a href='#tataTertib'>
      <button class='btn btn-orange btn-tatib'>Baca Tata Tertib!</button>
    </a>
    " : ""?>
  </div>
</section>
<?php }?>