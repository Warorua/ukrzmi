<?php
include './includes/session.php';
include 'home/blocks.php';

if (isset($wanted_blocks)) {
    $drp_cnt = $wanted_blocks;
  } else {
    $drp_cnt = 20;
  }
  
for ($bb = 1; $bb <= $drp_cnt; $bb++) {
    if (isset($block[$bb]['name'])) {
      echo dropdown(newsFetch(), $block, $bb);
    }
  }

