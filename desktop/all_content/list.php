<ul class="list-group list-group-flush">
<?php
if(1 == 1){
 if(isset($_GET['subcat'])){
  $block_news_1 = array_slice($block_news_orig,0,40);
 }
 elseif(isset($_GET['A0034'])){
  $block_news_1 = array_slice($block_news_orig,0,48);
 }
 else{
   $block_news_1 = array_slice($block_news_orig,40,40);
 }


$block_news_list = $block_news;
$allcount = sizeof($block_news)-1;
foreach($block_news_1 as $row){
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

$content = strip_tags(substr($row['article'],0,240)).'...';

      echo '

      <li id="post_'.$row['id'].'" class="list-group-item my-2 post2 p-0">
      <div class="row d-flex justify-content-start">
      
      <div class="w-25 mt-2">
       <div class="imgFrame">
        <a href="article_content.php?code='.$row['code'].'">
        <div class="imgTitle">
         <p class="blogTitle">'.$rowParent.'</p>
              <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
        <img class="cardPhotoList_2" src="../images/'.$row['photo'].'" height="130px" alt="'.$row['title'].'" />
         </div>
         </a> 
         </div> 
      </div>
      
      <div class="w-75">
      
      
      <div class="row">
      
      <div class="col-md-10">
      <div class="d-flex justify-content-between">
       <h5 class="text-dark" style="height:50px; overflow-y:hidden;"><b>'.$row['title'].'</b></h5>
       <a href="article_content.php?code='.$row['code'].'" class="stretched-link" ></a>
      
               <div class="btn-group dropend shareIcon">
              <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-ellipsis-v text-dark" aria-hidden="true"></i>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
               <li>
               <a class="dropdown-item trigger right-caret">Share</a>
               <ul class="dropdown-menu sub-menu">
               <li><a class="dropdown-item" href="https://t.me/share/url?url=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'&text='.$row['title'].'" target="_blank"><i class="fab fa-telegram" aria-hidden="true"></i> Telegram</a></li>
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
      
      
       <div class="w-100 d-flex justify-content-start">
         <small><span class="text-muted">'.$row['category'].' | '.timeago($row['time']).'</span></small>
         </div>
      </div>
      
      <div class="col-md-2">
      <div style="margin-top:0px" class="w-100">
         <a class="btn btn-outline-primary btn-sm " href="#">Full Coverage</a>
      </div> 
      </div>
      
      <div style="margin-top:4px" class="col-md-12">
      <p>
        '.$content.'
        </p>
      </div>
      </div>
           
      </div>
      
      </div>
      
      </li>   
  ';
}
}
//for ($x = 0; $x <= 48; $x++) {}
$_SESSION['all_content_list'] = $block_news;
?>  
</ul>
</div>
         <!-- End List Data Block -->

         <div class="d-grid gap-2 justify-content-end pe-5 me-1 pb-2">
 <button type="button" class="load-more2 btn btn-outline-dark btn-sm w-100 me-4">
 Load More
</button>
</div>
            
            <input type="hidden" id="row2" value="0">
            <input type="hidden" id="all2" value="<?php echo $allcount; ?>">
           

    <script>
        $(document).ready(function(){

// Load more data
$('.load-more2').click(function(){
    var row = Number($('#row2').val());
    var allcount = Number($('#all2').val());
   
    row = row + 4;

    if(row <= allcount){
        $("#row2").val(row);

        $.ajax({
            url: 'all_content/content_list_data.php',
            type: 'post',
            data: {row:row},
            beforeSend:function(){
                 //$(".btnspin").addClass("spinner-border spinner-border-sm");
                $(".load-more2").text("Loading...");
                $(".load-more2").prepend('<span class="spinner-border spinner-border-sm" role="status"></span> ');
               
            },
            success: function(response){

                // Setting little delay while displaying new content
                setTimeout(function() {
                    // appending posts after last post with class="post"
                    $(".post2:last").after(response).show().fadeIn("slow");

                    var rowno = row + 4;

                    // checking row value is greater than allcount or not
                    if(rowno > allcount){

                        // Change the text and background
                        $('.load-more2').text("No more data!");
                     
                        $('.load-more2').addClass("disabled btn-danger");
                    }else{
                        $(".load-more2").text("Load more");
                    }
                }, 2000);


            }
        });
    }else{
        $('.load-more2').text("Loading...");

        // Setting little delay while removing contents
        setTimeout(function() {

            // When row is greater than allcount then remove all class='post' element after 3 element
            $('.post2:nth-child(3)').nextAll('.post2').remove().fadeIn("slow");

            // Reset the value of row
            $("#row2").val(0);

            // Change the text and background
            $('.load-more2').text("Load more");
            $('.load-more2').css("background","#15a9ce");

        }, 2000);


    }

});

});
    </script>