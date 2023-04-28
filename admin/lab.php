<?php
include './includes/session.php';
$conn = $pdo->open();

$wanted_panels = 5;
$total_panel = $wanted_panels - 1;
for ($i = 1; $i <= $total_panel; $i++) {
      $panel_low = $i * 8;
      if ($i != $total_panel) {
            $panel_high = 8;
      } else {
            $panel_high = 7;
      }

      echo $panel_low . ' ' . $panel_high . '<br>';
}
 ?>
