<?php
include 'interview/main.php'
?>

<hr style="margin-top:10px"/>

 <!-- List Data Block -->
 <ul class="list-group list-group-flush">
 <?php
//Get first 3 from array
$list_first_item = array_slice($block_news,0,3);
$block_news_list = $block_news;
$allcount = sizeof($block_news)-1;
foreach($list_first_item as $row){
$rowtitle = $row['title'];  

$maxPos = 92;
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

echo '

<li id="post_'.$row['id'].'" class="list-group-item post w-100 p-1">
<div class="d-flex justify-content-between">

<div style="width: 40%;" class="">

  <a href="article_content.php?code='.$row['code'].'" class="stretched-link"></a>
  <div class="imgTitle_fc">
   <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame_3" style="border-color: '.$frameColor.';"></div>

        
  <img class="cardPhotoList_2" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="110px" alt="'.$row['title'].'" /> </div>
    
  
</div>

<div style="width: 60%;" class="">
<div class="">
  
<div style="height:70px" class="col-md-11 p-1 pt-0">
<a class="text-decoration-none text-dark" href="article_content.php?code='.$row['code'].'"> <h5 class="fw-light fs-6"><b>'.$rowtitle.'</b></h5></a>
</div>

<div class="d-flex justify-content-between p-1 pt-0">

<div class="col-md-12">
<div class="w-100 d-flex justify-content-start">
   <small><span class="text-muted">By '.$row['author'].'</span></small>
   </div>
</div>

<div class="col-md-1">
<div class="">
<a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
</a>
<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
<li>
<a class="dropdown-item trigger right-caret">Share</a>
<ul class="dropdown-menu sub-menu">
<li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i> Telegram</a></li>
<li><a class="dropdown-item" href="https://twitter.com/share?url=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Viber</a></li>
 <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
 <li><a class="dropdown-item" href="https://twitter.com/share?url=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
 <li><a class="dropdown-item" href="whatsapp://send?text=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
 <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=http://localhost/news/desktop/article_content.php?code='.$row['code'].'&media=https://localhost/news/scrap2/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
 
</ul>
</li>
 <li><hr class="dropdown-divider"></li>
 <li><a class="dropdown-item" href="full_coverage.php?id='.$row['id'].'" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
 <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
</ul>
</div> 
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

 <!------------------------------------->
  
  <!------------------------------------->
       
  
 </ul>
  <!-- End List Data Block -->

<div class="d-grid gap-2 d-flex justify-content-center mt-4">
 <button type="button" class="load-more btn btn-primary w-75">
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