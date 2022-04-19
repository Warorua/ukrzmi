<?php
  $ar_001 = $ar->children();
  $output .= sizeof($ar_001)." size of internal article<br/>";
  
 foreach($ar_001 as $ar_002){
 //$ar_sb = str_get_html($ar_002);

  $output .=  $ar_002;
  $ar_1 .= $ar_002;
////////P
$p_a = $ar_002->find("p, h1, h2, h3, h4, h5, h6, b, div[!id], span, strong, img, text");
foreach($p_a as $f){
$ar_tag = $f->tag;
//$output .=  $ar_tag."<br/>";
  // $output .=  $f->outertext.""; 
  //$ar_1 .=  $f->outertext."<br/>"; 
}

 }
?>