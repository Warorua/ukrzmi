<?php
include ('full_coverage/vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
 $tok = new WhitespaceTokenizer();
 
include 'voices/main.php'
?>

<hr style="margin-top:40px"/>

 <!-- List Data Block -->
 <ul class="list-group list-group-flush w-100">
 <?php
//Get first 3 from array
$list_first_item = array_slice($block_news,0,3);
$block_news_list = $block_news;
$allcount = sizeof($block_news)-1;
foreach($list_first_item as $row){
$rowtitle = $row['title'];  

$maxPos = 500;
if($row['sub_1'] != ''){
  $catHolder = $row['sub_1'];
 }else{
   $catHolder = 'Генеральний';
 }
if($row['parent'] == "ua.korrespondent.net"){
  $rowParent = "Кореспондент";
}
elseif($row['parent'] == "pravda.com.ua"){
  $rowParent = "правда";
}
elseif($row['parent'] == "eurointegration.com.ua"){
  $rowParent = "євроінтеграція";
}
elseif($row['parent'] == "unian.ua"){
  $rowParent = "уніанської";
}
elseif($row['parent'] == "life.pravda.com.ua"){
  $rowParent = "правда";
}
elseif($row['parent'] == "theguardian.com"){
  $rowParent = "The guardian";
}
elseif($row['parent'] == ""){
  $rowParent = "правда";
}



if (strlen($row['title']) < $maxPos){
  $rowtitle = $row['title'];
  $filtTit = str_replace('"', '', $row['title']);
}
else{
    $lastPos = ($maxPos - 3) - strlen($row['title']);
      $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . '...'; 
} 
if($row['frame_color'] == ""){
  $frameColor = "rgb(0, 0, 0, 0.0)";
}
else{
  $frameColor = $row['frame_color'];
}
if($row['title_badge'] == ""){
  $titleBadge = "";
}
else{
  $titleBadge = '<img src="../admin/'.$row['title_badge'].'" class="titleBadge" />';
}

$content = strip_tags(substr($row['article'],0,260)).'...';
if($row['type'] == 'video'){
  $fc_icon = '<div class="fcIcon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
  $fc_icon_title = '<i class="fa fa-play-circle" aria-hidden="true"></i>';
  $fc_link = 'video_content';
}
elseif($row['type'] == 'podcast'){
  $fc_icon = '<div class="fcIcon"><i class="fa fa-podcast" aria-hidden="true"></i></div>';
  $fc_icon_title = '<i class="fa fa-podcast" aria-hidden="true"></i>';
  $fc_link = 'podcast';
}
elseif($row['type'] == ''){
  $fc_icon = '';
  $fc_icon_title = '';
  $fc_link = 'article_content';
}
else{
  $fc_icon = '';
  $fc_icon_title = '';
  $fc_link = 'article_content';
}
if(!isset($row['voice_profile'])){
  $profile = $row['photo'];
}
else{
  $profile = $row['voice_profile'];
}
  $contentFull = strip_tags($row['article']);
$setA = $tok->tokenize($contentFull);
$contentTime = number_format(sizeof($setA)/200, 0);
echo '
<li class="list-group-item my-2 post ps-0 pe-0">
<div class="row">

<div class="col-md-9">
<div class="row">
<div class="col-md-1">
<img width="35px" src="https://www.pravda.com.ua/android-chrome-192x192.png"/>
</div>
<div class="col-md-10">
<a href="'.$fc_link.'.php?code='.$row['code'].'" class="text-dark stretched-link text-decoration-none">
<h5 class="">'.$row['title'].'</h5>        
</a>  
   <div class="w-100 justify-content-start">
   <small style="margin-top:25px">
   <span class="text-muted">'.$contentTime.' Minutes
    <span style="font-size:5px; margin-left:4px; margin-right:4px; padding-bottom:10px;">
    <i style="font-size:5px; margin-left:4px; margin-right:4px;" class="fa fa-circle" aria-hidden="true"></i>
 </span>
    
  '.timeago($row['time']).' 
 </span>
 </small>
   </div>  
</div>
<div class="col-md-1">
<div class="btn-group dropend shareIcon">
<a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
</a>
<ul class="dropdown-menu">
 <li><h6 class="dropdown-header">Share</h6></li>
  <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
  <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
  <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
  <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'&media=https://www.ukrzmi.com/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
  <li><hr class="dropdown-divider"></li>
  <li><a class="dropdown-item" href="full_coverage.php?id='.$row['id'].'" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
  <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
</ul>
</div>
</div>
</div>
 
      
</div>

<div class="col-md-3">

<div class="card voiceCard_2">
  <div class="card-body">
  <div class="d-flex">
  <img src="../images/'.$profile.'" width="40px" height="40px"  class="rounded-circle" alt="...">
    <h6 style="white-space:nowrap" class="card-title p-2 lh-base fw-normal">'.$row['author'].'</h6>
  </div>
  <p style="font-size:12px; line-height:1.2;" class="text-muted">With supporting text below as a natural lead-in.</p>
 
  </div>
</div>

</div>

</li>
';


}
$_SESSION['voice_items'] = $block_news;
?>

            <!-- End List Data Block -->

<div class="d-grid gap-2 justify-content-end pe-5 me-1">
 <button type="button" class="load-more btn btn-outline-dark btn-sm w-100 me-4">
 Load More
</button>
</div>
            
            <input type="hidden" id="row" value="0">
            <input type="hidden" id="all" value="<?php echo $allcount; ?>">
           

    <script>
        $(document).ready(function(){

// Load more data
$('.load-more').click(function(){
    var row = Number($('#row').val());
    var allcount = Number($('#all').val());
   
    row = row + 4;

    if(row <= allcount){
        $("#row").val(row);

        $.ajax({
            url: 'voices/list_data.php',
            type: 'post',
            data: {row:row},
            beforeSend:function(){
                 //$(".btnspin").addClass("spinner-border spinner-border-sm");
                $(".load-more").text("Loading...");
                $(".load-more").prepend('<span class="spinner-border spinner-border-sm" role="status"></span> ');
               
            },
            success: function(response){

                // Setting little delay while displaying new content
                setTimeout(function() {
                    // appending posts after last post with class="post"
                    $(".post:last").after(response).show().fadeIn("slow");

                    var rowno = row + 4;

                    // checking row value is greater than allcount or not
                    if(rowno > allcount){

                        // Change the text and background
                        $('.load-more').text("No more data!");
                     
                        $('.load-more').addClass("disabled btn-danger");
                    }else{
                        $(".load-more").text("Load more");
                    }
                }, 2000);


            }
        });
    }else{
        $('.load-more').text("Loading...");

        // Setting little delay while removing contents
        setTimeout(function() {

            // When row is greater than allcount then remove all class='post' element after 3 element
            $('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");

            // Reset the value of row
            $("#row").val(0);

            // Change the text and background
            $('.load-more').text("Load more");
            $('.load-more').css("background","#15a9ce");

        }, 2000);


    }

});

});
    </script>