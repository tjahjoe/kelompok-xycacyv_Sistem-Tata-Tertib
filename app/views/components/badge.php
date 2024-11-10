<?php
function Badge($status)
{
  $badgeColor = 'gray';
  switch ($status) {
    case 'baru':
      $badgeColor = 'orange';
      $status = 'Pending';
      break;
    case 'aktif':
      $badgeColor = 'purple';
      $status = 'Processing';
      break;
    case 'nonaktif':
      $badgeColor = 'green';
      $status = 'Completed';
      break;
    case 'reject':
      $badgeColor = 'red';
      $status = 'Rejected';
      break;
  }
?>
  <span class="badge badge-<?php echo $badgeColor ?>"><?php echo $status ?></span>
<?php } ?>