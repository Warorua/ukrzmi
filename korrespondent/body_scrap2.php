<?php
   $ar_001 = $ar_sz->children();
   $output .= sizeof($ar_001)." size of internal article<br/>";
   $ar_sz->last_child()->outertext="";
  foreach($ar_001 as $ar_002){
  //$ar_sb = str_get_html($ar_002);
 
   //$output .=  $ar_002;
   //$ar_1 .= $ar_002;
 ////////Particle-shares
 $p_a = $ar_002->find("p, h1, h2, h3, h4, div[!id], strong, img[alt!=google], text");
 foreach($p_a as $f){
 $ar_tag = $f->tag;
 //$output .=  $ar_tag."<br/>";
 $f->class="scrape_remove";
 $f->href=null;

   // $output .=  $f->outertext;
  
  // $output .=  $f->children(0)->tag."<br/>";
  if($f->children(0)->tag == 'em'){
     $ar_11 .= "";
   }
  else{
     $ar_11 .=  $f->outertext; 
  }
   
 }

  }
 $ar_11 = '<style>
 
 span.scrape_remove{
  visibility: hidden;
  color:green;
  }

  span strong.scrape_remove{
    visibility: hidden;
    color:green;
    }

 em.scrape_remove{
  visibility: hidden!important;
  }

  em.scrape_remove a{
    visibility: hidden!important;
    }

em{
      visibility: hidden!important;
  }
  
 div.scrape_remove a{
  visibility: hidden;
  }
 </style>' . $ar_11 ;
 $output .=  $ar_11;

?>