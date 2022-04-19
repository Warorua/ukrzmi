<?php
 
require_once 'vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';

$detect = new Mobile_Detect;
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
    header("location:mobile/home.php");
 //echo 'You are on MOBILE';
}
else{
      header("location:desktop/home.php");
  //  echo 'You are on DESKTOP';
}
 
?>
 