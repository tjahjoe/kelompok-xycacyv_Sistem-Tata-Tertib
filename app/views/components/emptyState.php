<?php
function EmptyState($image, $text)
{
?>
  <div class="empty-state">
    <img src="../assets/images/<?php echo $image?>" alt="" class="">
    <h3><?php echo $text;?></h3>
  </div>
<?php
}
?>