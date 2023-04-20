
<ul class="list-group list-group-flush">
<li class="list-group-item border border-0">
    <i><?php echo $val ?></i>
   <p class="searchCont text-muted mt-0">About <?php echo sizeof($fc_array) ?> results</p>
 </li>
<?php
$list_first_item = array_slice($fc_array,0,10);
$fc_array_list = $fc_array;
$allcount = sizeof($fc_array)-1;
if(sizeof($fc_array) == 0){
    echo '
<li class="list-group-item border border-0">
   <div class="d-flex justify-content-center">
   <div class="m-3 d-flex justify-content-center text-danger w-50"><i class="fa fa-exclamation-triangle fa-3x"></i></div>
   <div class="m-3 d-flex justify-content-start text-danger w-50 fs-3 fw-bold">No data found!</div>
   </div>
 </li>
    ';
$btnSet = "btn btn-secondary disabled";
}
else{
    $btnSet = "";  
}
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
    
    
    
    if (strlen($row['title']) > $maxPos)
    {
        $lastPos = ($maxPos - 3) - strlen($row['title']);
          $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . ' 
 ...';
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
$art_cont = substr(strip_tags($row['article']),0,280).'...';

          echo '
  <li class="list-group-item border border-0 post">
  <a href="'.$fc_link.'.php?code='.$row['code'].'" class="stretched-link"></a>
          <div><h3 class="searchHead">'.$row['title'].'<tx class="text-muted fs-6">('.$rowParent.')</tx></h3></div>
          <p class="searchCont text-muted mt-0">'.timeago($row['time']).' - '.$art_cont.'</p>
      </li>
      ';
     // echo $row['full_coverage'];
    }
$_SESSION['search_items'] = $fc_array;
?>

  
</ul>

<div class="d-grid gap-2 mb-2">
 <button type="button" class="load-more btn btn-primary <?php echo $btnSet ?>">
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
            url: 'search/list_data.php',
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