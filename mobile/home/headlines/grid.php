
<?php //echo $block[0]['name']; ?>

<div id="mixedSlider" class=" ">

<div class="MS-content">
<?php
if($block[0]['active'] == 1){

 include 'home/panels/headline_query.php';
    
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM pinned WHERE block_id=:block_id AND page=:page");
  $stmt->execute(['block_id'=>$block[0]['id'], 'page'=>'']);
  $block_auth = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM pinned
  LEFT JOIN news ON pinned.card_id = news.id 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
  AND block_id=:block_id
  AND page=:page
  ORDER BY pinned.position ASC");
  $stmt->execute(['cat_not'=>'international', 'page'=>'', 'type'=>"", 'pin'=>1, 'block_id'=>$block[0]['id'], 'page'=>'']);
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
  
  $block_news_1 = array_slice($block_news,0,30);

foreach($block_news_1 as $value => $row){
$rowtitle = $row['title'];  

$maxPos = 92;
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
$art1 =  strip_tags($row['article']);
$articleCon = substr($art1,0,500).'...<small class="text-muted fx-3">(More)</small>';
$artno = $value+1;

      echo '
<div class="item">    
  <div class="card w-100">
  <div class="card-title headlinesTitle" data-toggle="tooltip" data-placement="bottom" title="'.$row['title'].'">
  '.$row['title'].'
</div>
  <div class="w-100">

<div class="imgFrame">
      <div class="imgTitle_2"> 
      <p class="blogTitle_2">'.$artno.'/30</p>
        <img class="cardPhoto_head" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="122px" alt="'.$row['title'].'" />   
    </div>
 </div>   
 
</div>
<a href="article_content.php?code='.$row['code'].'" class="stretched-link"></a>
<div class="card-text p-0">
<p><span class="text-primary">'.$rowParent.': </span>'.$articleCon.'
</p>
</div>  
  </div>
 </div>
 ';
}
}
//for ($x = 0; $x <= 48; $x++) {}
?>  


</div>
<div class="MS-controls">
       <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
      <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
</div>

</div>
<div class="d-flex justify-content-center">
<a class="btn btn-outline-dark w-75">All headlines</a>
</div>



<script src="../bower/multislider.js"></script> 
<script>
		$('#mixedSlider').multislider({
			duration: 750,
			interval: 3000
		});
</script>