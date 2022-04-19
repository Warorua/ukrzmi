<div class="">
    <div class="topRow">
        <div class="">

<?php
$nav = $_SERVER['PHP_SELF'];
$nav_link = basename($nav);

if(isset($data['category'])){
  $topCat = $data['category'];
}
elseif(isset($_GET['cat_id'])){
  $topCat = $_GET['cat_id'];
}
elseif($nav_link == 'tag.php'){
  $topCat = 'TAGS';
}
elseif($nav_link == 'search.php'){
  $topCat = 'SEARCH';
}
elseif($nav_link == 'city.php'){
  $topCat = 'NEWS <tx class="text-uppercase">'.$city.'</tx>';
}
else{
  $topCat = 'NEWS UKRAINE';
}



if($nav_link == 'full_coverage.php'){
  $topCat = 'FULL COVERAGE';
  $topHide = 'style="display:none"';
}
else{
  $topHide = '';
}
/////////////video
if($nav_link == 'video.php' || $nav_link == 'video_content.php'){
  $topClassVideo = 'text-primary border-bottom-4 border-primary';
  $topClass = 'text-dark';
}
else{
  $topClass = 'text-dark';
  $topClassVideo = 'text-dark';
}
/////////////interview
if($nav_link == 'interview.php'){
  $topClassInterview = 'text-primary border-bottom-4 border-primary';
  $topClass = 'text-dark';
}
else{
  $topClass = 'text-dark';
  $topClassInterview = 'text-dark';
}
/////////////voices
if($nav_link == 'voices.php'){
  $topClassVoice = 'text-primary border-bottom-4 border-primary';
  $topClass = 'text-dark';
}
else{
  $topClass = 'text-dark';
  $topClassVoice = 'text-dark';
}
/////////////home
if($nav_link == 'home.php'){
  $topClassHome = 'text-primary border-bottom-4 border-primary';
  $topClass = 'text-dark';
}
else{
  $topClass = 'text-dark';
  $topClassHome = 'text-dark';
}

  

?>



<div <?php echo $topHide ?> class="navbarBottom">
<ul class="nav navTopp d-flex justify-content-between position-relative">

  <li class="nav-item">
    <a class="nav-link navLink  text-dark" href="#">My Channel</a>
  </li>
    <?php
    if(isset($_GET['cat_id'])){
   $stmt = $conn->prepare("SELECT *, sub_cat.name AS subcat FROM sub_cat LEFT JOIN category ON sub_cat.category=category.id WHERE category.name=N'".$_GET['cat_id']."'");
$stmt->execute();
$sub_cats = $stmt->fetchAll();
foreach($sub_cats as $row){
  echo '
  <li class="nav-item">
  <a class="nav-link navLink " href="#">'.$row['subcat'].'</a>
</li>
  ';
}   
    }

  ?>
  <li class="nav-item">
    <a class="nav-link navLink  <?php echo $topClassHome ?>" href="home.php">All News</a>
  </li>
  <li class="nav-item">
    <a class="nav-link navLink  <?php echo $topClassInterview ?>" href="interview.php">Interviews</a>
  </li>
  <li class="nav-item ">
    <a class="nav-link navLink  <?php echo $topClassVoice ?>"  href="voices.php">Voices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link navLink  <?php echo $topClassVideo ?>" href="video.php">Videos</a>
  </li>
  
</ul>
 
</div>
 <hr <?php echo $topHide ?> class="navbarHr">



 </div>


<div class="d-flex justify-content-between">
<h3 class="text-primary pageCat"><?php echo $topCat ?></h3>
<div <?php echo $topHide ?> class="">
<div class="text-primary pageDesc">"Inspiring trust"</div>
</div>
</div>



    </div>
  
</div>