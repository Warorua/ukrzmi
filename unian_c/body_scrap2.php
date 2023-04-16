<?php
include_once('../pravda/inc/simple_html_dom.php');
$ar_001 = $ar->children();
$output .= sizeof($ar_001) . " size of internal article<br/>";

foreach ($ar_001 as $ar_002) {
  //$ar_sb = str_get_html($ar_002);

  //$output .=  $ar_002;
  //$ar_1 .= $ar_002;
  ////////Particle-shares
  $p_a = $ar_002->find("p, h1, h3, h4, h5, h6, b, div[class!=read-also-slider][class!=owl-photo], strong, img[alt!=google], text, a[!href]");
  foreach ($p_a as $f) {
    $ar_tag = $f->tag;
    //$output .=  $ar_tag."<br/>";
    //$f->class=null;
    //$f->href=null;
    $output .=  $f->outertext . "";
    $ar_1 .=  $f->outertext . "<br/>";
  }
  $ar_fil = str_get_html($ar_1);
  $ar_fil2 = $ar_fil->find('.owl-photo__item');
  $ar_fil3 = sizeof($ar_fil2);
  if ($ar_fil3 > 5) {
    $ar_error = 1;
  } else {
    $ar_error = "";
  }
}
?>