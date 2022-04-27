<div class="row">
<div class="col-md-3 <?php if(!isset($_GET['page']) || isset($_GET['A0034'])){echo 'visually-hidden';} ?>">    
  <div class="card col-sm-4 col-md-3 newsCard">
    <div class="card-content">
<div class="imgFrame">
      <div class="imgTitle">
        <div class="cardFrame d-flex align-items-center justify-content-center" style="border-color: grey;">
      <tx class="text-secondary text-center">Previous seen headlines</tx>
      </div>   
    </div>
 </div>   
 <a href="<?php echo $prevCont ?>" class="stretched-link"> </a>        
  </div>
  </div>    
</div>

<?php
if(1 == 1){
 if(isset($_GET['subcat'])){
  $block_news_1 = array_slice($block_news_orig,0,39);
 }
 elseif(isset($_GET['A0034'])){
  $block_news_1 = array_slice($block_news_orig,0,47);
 }
 else{
   $block_news_1 = array_slice($block_news_orig,40,39);
 }


$block_news_list = $block_news;
$allcount = sizeof($block_news)-1;
foreach($block_news_1 as $row){
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
      $filtTit = str_replace('"', '', $row['title']); 
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
if($row['type'] == 'video'){
  $fc_icon = '<div class="fcIconVid"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
}
else{
  $fc_icon = '';
}
////////////////////////////////////////////////
if($row['type'] == 'video'){
  $fc_link = 'video_content';
}
elseif($row['type'] == 'podcast'){
 $fc_link = 'podcast';
}
elseif($row['type'] == ''){
 $fc_link = 'article_content';
}
else{
$fc_link = 'article_content';
}

      echo '
  <div class="col-md-3 post">    
  <div class="card col-sm-4 col-md-3 newsCard">
    <div class="card-content">

<a href="'.$fc_link.'.php?code='.$row['code'].'">
<div class="imgFrame">
      <div class="imgTitle">
         <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
        <img class="cardPhoto" src="../images/'.$row['photo'].'" height="122px" alt="'.$row['title'].'" />
        '.$fc_icon.'
    </div>
 </div>   
  </a>    
    <div class="card-body">
          <a href="'.$fc_link.'.php?code='.$row['code'].'" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="'.$row['title'].'">'.$titleBadge.''.$rowtitle.'</h6></a>
      <div class="cardFoot clearfix">
        <div class="cardCat">
         <div class="btn-group dropend shareIcon">
        <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v text-dark" aria-hidden="true"></i>
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

    <p class="cardTime">'.timeago($row['time']).'</p>  

    <div class="ellipBox">
      <p class="cardEllip"></p>
    </div>
    
<p class="cardCategory">'.$row['category'].'</p>
         </div>
      </div>
    </div>
   
    
  </div>
  </div>    </div>
  ';
}
}
//for ($x = 0; $x <= 48; $x++) {}
$_SESSION['all_content_grid'] = $block_news;
?>  
</div>

<div class="d-grid gap-2 justify-content-end pe-5 me-1 <?php echo $btnHd ?>">
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
   
    row = row + 8;

    if(row <= allcount){
        $("#row").val(row);

        $.ajax({
            url: 'all_content/content_grid_data.php',
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

                    var rowno = row + 8;

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
