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
      $badgeColor = 'blue';
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
    default:
      $status = 'Undefined';
      break;
  }
 return "<span class='badge badge-" . $badgeColor . '\'>' . $status . "</span>";
?>
<?php } ?>