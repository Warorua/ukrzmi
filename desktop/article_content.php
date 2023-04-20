<?php
include ('full_coverage/vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
 $tok = new WhitespaceTokenizer();
 
 function formatMilliseconds($milliseconds) {
    $seconds = floor($milliseconds / 1000);
    $minutes = floor($seconds / 60);
    $hours = floor($minutes / 60);
    $milliseconds = $milliseconds % 1000;
    $seconds = $seconds % 60;
    $minutes = $minutes % 60;

    $format = '%02u Minutes';
    $time = sprintf($format, $minutes, $seconds, $milliseconds);
    return rtrim($time, '0');
}

include 'includes/header.php';

?>
<body>
    
    <?php include_once("analyticstracking.php") ?>
    
    
    <div id="">
<?php
include 'home/blocks.php';
include 'content/auth.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
</div>
<div></div>
<div id="myBody" class="newsContainer">
    <div class="row homeContent">
    
        <div id="showSpace" class="col-md-9 catColumn">
<div class="row">
<?php
include 'content/title_row.php';
include 'content/img_row.php';
?>
<div class="row catContent">
 
    <div class="col-md-12">   <hr/></div>
    <div class="col-md-9 catTool">
<ul class="nav justify-content-start">
  <li class="nav-item">
    <a class="nav-link disabled"><i class="fa fa-tags" aria-hidden="true"></i></a>
  </li>

  <li class="nav-item">
    <a class="nav-link text-secondary" href="tag.php?tag_id=<?php echo $data['tag_1'] ?>"><?php echo $data['tag_1'] ?></a>
  </li>

  <li class="nav-item">
    <a class="nav-link text-secondary" href="tag.php?tag_id=<?php echo $data['tag_2'] ?>"><?php echo $data['tag_2'] ?></a>
  </li>

  <li class="nav-item">
    <a class="nav-link text-secondary" href="tag.php?tag_id=<?php echo $data['tag_3'] ?>"><?php echo $data['tag_3'] ?></a>
  </li>
  
</ul>   
</div>
<div class="col-md-3 catTool">
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link text-secondary">
    <i id="resettext" class="fa fa-undo" aria-hidden="true"></i>
    <i id="decreasetext" type="button" class="fa fa-font" aria-hidden="true"></i>
    <i id="increasetext" type="button" class="fa fa-font fa-lg" aria-hidden="true"></i>
    </a>
  </li>
  <li id="testHide" class="nav-item">
    <a class="nav-link">
        <i id="lightOff" class="fa fa-lightbulb-o fa-lg text-warning"></i>
        <i id="lightOn" class="fa fa-lightbulb-o fa-lg text-dark"></i>
    </a>
  </li>

</ul>
 </div>

 <div style="font-size: 13px;" class="col-md-12">
 <ul class="nav">
  <li class="nav-item">
    <a class="nav-link disabled">
    <?php
$contentFull = strip_tags(closetags($article));
$setA = $tok->tokenize($contentFull);
$contentTime = number_format(sizeof($setA)/200, 1)*60000;
if(formatMilliseconds($contentTime) < 1){
  $arcTime = '1 Minute';
}else{
  $arcTime = formatMilliseconds($contentTime);
}
    ?>
    <i  style="margin-right:10px" class="fa fa-clock-o" aria-hidden="true"></i>  <?php echo $arcTime ?>
    </a>
  </li>
</ul>
 </div>


 <div id="cardContent" class="col-md-12 article_content">
 <?php echo closetags($article) ?>
 
 <div class="row mt-3">
            <div class="col-md-12 mt-3">
 <a href="<?php echo $data['deep_link'] ?>" target="_blank">Read article from the source</a>
       </div>
       <div class="col-md-12 mt-3">
<a href="full_coverage.php?id=<?php echo $data['id'] ?>" target="_blank">Get full coverage</a>
       </div>
 </div>
 </div>
</div>

</div>
<div style="margin-bottom:10px" class="col-md-12">   <hr/></div>
   <!--------------------------------------------------------------------------------------------------->
 <?php
include 'videos/eval_section.php';
?>
<div style="margin-bottom:10px" class="col-md-12">   <hr/></div>
<?php
include 'videos/comment_section.php';
?>
        </div>

        <div id="hideSpace" class="col-md-3 cardColumn_2">
        
        <?php
include 'home/ad_column.php';
?>
        </div>
    </div>

</div>
<?php
include 'includes/footer.php';
include 'includes/script.php';
?>

<?php
include 'content/auth_js.php';
?>


</body>