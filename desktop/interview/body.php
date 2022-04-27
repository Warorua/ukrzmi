<?php
include ('full_coverage/vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
 $tok = new WhitespaceTokenizer();
include 'interview/main.php'
?>

<hr style="margin-top:40px"/>

 <!-- List Data Block -->
 <ul class="list-group list-group-flush">
 <?php
//Get first 3 from array
$block_news = array_slice($block_news,4);
$list_first_item = array_slice($block_news,0,12);
$block_news_list = $block_news;
$allcount = sizeof($block_news)-1;
foreach($list_first_item as $row){
$rowtitle = $row['title'];  

$maxPos = 500;
if($row['sub_1'] != ''){
  $catHolder = $row['sub_1'];
 }else{
   $catHolder = 'General';
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
      $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . ' 
 ...'; 
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
$contentFull = strip_tags($row['article']);
$setA = $tok->tokenize($contentFull);
$contentTime = number_format(sizeof($setA)/200, 0);

$authorFil = str_replace('—', "", $row['author']);
echo '

<li style="border:none" id="post_'.$row['id'].'" class="list-group-item my-2 post">
<div class="row">

<div class="col-md-3">
 <div class="imgFrame">
  <a href="article_content.php?code='.$row['code'].'">
  <div class="imgTitle">
   <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame_3" style="border-color: '.$frameColor.';"></div>

        <div class="intBadge">
        <div class="bd_1">'.$row['time'].'</div>
        <div class="bd_2"> | 
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
      </svg>
       '.$contentTime.'m</div>
        </div>
        
  <img class="cardPhotoList_2" src="../images/'.$row['photo'].'" height="110px" alt="'.$row['title'].'" />
   </div>
   </a> 
   </div> 
</div>

<div class="col-md-9">


<div class="row">

<div class="col-md-11">
<a class="text-decoration-none text-dark" href="article_content.php?code='.$row['code'].'"> <h5 class="fw-light fs-6"><b>'.$row['title'].'</b></h5></a>
 
</div>

<div class="col-md-1">
<div style="margin-top:15px" class="dropstart">
<a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
</a>
<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
<li>
<a class="dropdown-item trigger right-caret">Share</a>
<ul class="dropdown-menu sub-menu">
<li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i> Telegram</a></li>
<li><a class="dropdown-item" href="viber://forward?text=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fab fa-viber" aria-hidden="true"></i> Viber</a></li>
 <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
 <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
 <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
 <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'&media=https://www.ukrzmi.com/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
 
</ul>
</li>
 <li><hr class="dropdown-divider"></li>
 <li><a class="dropdown-item" href="full_coverage.php?id='.$row['id'].'" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
 <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
</ul>
</div> 
</div>

<div style="margin-top:55px" class="col-md-12">
<div class="w-100 d-flex justify-content-start">
   <small><span class="text-muted">By '.$authorFil.'</span></small>
   </div>
</div>
</div>
     
</div>

</div>

</li>    
';


}
$_SESSION['interview_items'] = $block_news;
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
            url: 'interview/list_data.php',
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