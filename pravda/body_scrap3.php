<?php
    $ar_001 = $ar->children();
    $output .= sizeof($ar_001)." size of internal article<br/>";
    
   foreach($ar_001 as $ar_002){
   //$ar_sb = str_get_html($ar_002);

//     $output .=  $ar_002;


////////P
   $p_a = $ar_002->find("p");
   foreach($p_a as $f){
   $ar_tag = $f->tag;
   $output .=  $ar_tag."<br/>";
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////H1
$h1_a = $ar_002->find("h1");
   foreach($h1_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////H2
$h2_a = $ar_002->find("h2");
   foreach($h2_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////H3
$h3_a = $ar_002->find("h3");
   foreach($h3_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////H4
$h4_a = $ar_002->find("h4");
   foreach($h4_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////H5
$h5_a = $ar_002->find("h5");
   foreach($h5_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////H6
$h6_a = $ar_002->find("h6");
   foreach($h6_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////DIV
$div_a = $ar_002->find("div");
   foreach($div_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////B
$b_a = $ar_002->find("b");
   foreach($b_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////IMG
$img_a = $ar_002->find("img");
   foreach($img_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }
////////SPAN
$span_a = $ar_002->find("span");
   foreach($span_a as $f){
   $ar_tag = $f->tag;
        $output .=  $f->outertext."<br/>"; 
       $ar_1 .=  $f->outertext."<br/>"; 
   }

   }
 
?>