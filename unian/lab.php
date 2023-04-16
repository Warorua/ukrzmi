<?php
function getElementAttr($html, $element, $attribute) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_use_internal_errors(false);
    $xpath = new DOMXPath($dom);
    $class = '';
    
    // find the first matching element and get its class attribute
    $elements = $xpath->query("//{$element}");
    if ($elements->length > 0) {
        $class = $elements->item(0)->getAttribute($attribute);
    }
    
    return $class;
}
  
$f ='<img
data-src="https://images.unian.net/photos/2022_02/thumb_files/370_250_1644340004-1635.jpg"
alt="Польща заборонила ввезення зерна та іншого продовольства з України" width="370" height="130"
src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="><br />';
  
$class = GetElementAttr($f, 'img', 'src');
  
 echo $class; 