<?php
include 'includes/header.php';
if(isset($_GET['subcat'])){
    $conn = $pdo->open();
   $stmt = $conn->prepare("SELECT * FROM news WHERE sub_1=N'".$_GET['subcat']."'");
   $stmt->execute();
   $block_news_orig = $stmt->fetchAll();
   $page = 'subcat';
   $block_id = 0;
   $titleHead = '<h2 class="newsHead">'.$_GET['subcat'].' sub-category content</h2>';
}
else{
   if(!isset($_GET['page']) && !isset($_GET['block_id'])){
    header('location: home.php');
}
else{
    if($_GET['page'] == 'home' || $_GET['page'] == 'category' || $_GET['page'] == 'video' || $_GET['page'] == 'city'){
        $page = $_GET['page'];
    }
    else{
        header('location: home.php');
    }
}
$block_id = $_GET['block_id'];
$block_news_orig = $_SESSION[$page]; 
if(!isset($block[$block_id]['name'])){
    $title = 'Headlines';
}else{
    $title = $block[$block_id]['name'];
}
$titleHead = '<h2 class="newsHead">'.$title.' all content</h2>';
}





$block_news_orig = array_slice($block_news_orig,39);
function cardDescSort($item1,$item2)
{
    if ($item1['id'] == $item2['id']) return 0;
    return ($item1['id'] > $item2['id']) ? -1 : 1;
}
usort($block_news_orig,'cardDescSort');
?>
<body class="">
<?php
include 'home/blocks.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
<div class="newsContainer">
    <div class="row homeContent">
        <div class="col-md-9 col-lg-9 col-xl-9 cardColumn">

<?php //echo $block[1]['name']; ?>
<?php echo $titleHead; ?>
<div  class="cardBlock row">


<div class="">

<div class="row">
  <?php
if(1 == 1){

  
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM pinned WHERE block_id=:block_id AND page=:page");
  $stmt->execute(['block_id'=>$block[$block_id]['id'], 'page'=>$page]);
  $block_auth = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM pinned
  LEFT JOIN news ON pinned.card_id = news.id 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
  AND block_id=:block_id
  AND page=:page
  ORDER BY pinned.position ASC");
  $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>1, 'block_id'=>$block[$block_id]['id'], 'page'=>$page]);
  $block_news_pinned = $stmt->fetchAll();
  foreach($block_news_pinned as $value => $row){
     $pos = $row['position'];      
    $val = Array
          (
              'id' => $row['id'],
              'position' => $row['position'],
              'source' => $row['source'],
             'deep_link' => $row['deep_link'],
              'title' => $row['title'],
              'published' => $row['published'],
              'author' => $row['author'],
              'article' => $row['article'],
              'tag_1' => $row['tag_1'], 
              'tag_2' => $row['tag_2'] ,
              'tag_3' => $row['tag_3'] ,
             'photo' => $row['photo'],
              'photo_url' => $row['photo_url'],
              'p_grapher' => $row['p_grapher'],
              'category' => $row['category'],
              'time' => $row['time'],
              'code' => $row['code'],
              'parent' => $row['parent'],
              'type' => $row['type'],
              'video_url' => $row['video_url'],
              'frame_color' => $row['frame_color'],
              'title_badge' => $row['title_badge'],
              'meta_title' => $row['meta_title'],
              'meta_desc' => $row['meta_desc'],
              'meta_keywords' => $row['meta_keywords'],
              'post_date' => $row['post_date'],
              'pin' => $row['pin'],
              'sub_1' => $row['sub_1'],
              'sub_2' => $row['sub_2'],
              'intefax' => $row['intefax'],
              'source_error' =>$row['source_error'],
              'input' => $row['input']
          );
  
  $block_news = array_merge(array_slice($block_news_orig, 0, $pos), array($val), array_slice($block_news_orig, $pos));
  
    $block_news_orig = $block_news;
  
  }
  if($block_auth['numrows'] < 1){
    $block_news = $block_news_orig;
  }

$block_news_1 = array_slice($block_news,0,8);
$block_news_list = $block_news;
$allcount = sizeof($block_news)-1;
foreach($block_news_1 as $row){
$rowtitle = $row['title'];  

$maxPos = 102;
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
  <div class="card col-sm-4 col-md-3 newsCard" style="background-color:'.$block[$block_id]['bg_color'].'">
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
$_SESSION['all_content_items'] = $block_news;
?>  

</div>

</div>




</div>

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
   
    row = row + 8;

    if(row <= allcount){
        $("#row").val(row);

        $.ajax({
            url: 'content/content_list_data.php',
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












  <?php
include 'includes/subscribe.php';
?>

        </div>

        <div class="col-md-3 cardColumn_2">
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
</body>