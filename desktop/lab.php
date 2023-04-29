<?php
include './includes/session.php';
include 'home/blocks.php';

for ($bb = 1; $bb <= $drp_cnt; $bb++) {
    if (isset($block[$bb]['name'])) {
      echo dropdown(newsFetch(), $block, $bb);
    }
  }

