<div class="container-fluid">
    <div style="height: 100px" class="row topRow">
        <div class="col-md-9">
<div class="navbarBox">
    <nav class="navbar navbar-expand-lg navbar-light">
    <div class="">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content">
        <div class="hamburger-toggle">
          <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </button>
      <div class="collapse navbar-collapse" id="navbar-content">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
    <a class="nav-link navLink  dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">All cities</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="city.php?id=kyiv">Kyiv</a></li>
      <li><a class="dropdown-item" href="city.php?id=lviv">Lviv</a></li>
      <li><a class="dropdown-item" href="city.php?id=odessa">Odessa</a></li>
      <li><a class="dropdown-item" href="city.php?id=kharkiv">Kharkiv</a></li>
      <li><a class="dropdown-item" href="city.php?id=dnepropetrovsk">Dnepropetrovsk</a></li>
    
      
    </ul>
  </li>
  <li class="nav-item vr"></li>
          <?php

          if(isset($city)){
            $navStatus = '';
            $navHide = 'visually-hidden';
          }
          else{
            $navStatus = 'visually-hidden';
            $navHide = '';
          }
    $cardSam = '
<div style="margin-left:0 px" class="col-md-3">    
  <div class="card col-sm-4 col-md-3 newsCard">
    <div  class="card-content">

<a href="article_content.php?code=XQ9ROwEfW8lq">
 <div class="imgFrame" style="border-color: rgb(0, 0, 0, 0.0);">
      <div class="imgTitle">
        <p class="blogTitle">правда</p>
        <img class="cardPhoto" src="../images/1643021008.jpg" height="122px" alt="На Харківщині відпрацьовано понад 10 можливих сценаріїв у разі нападу Росії – СБУ

" />
    </div>
 </div>   
  </a>    
    <div class="card-body">
          <a href="article_content.php?code=XQ9ROwEfW8lq" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="На Харківщині відпрацьовано понад 10 можливих сценаріїв у разі нападу Росії – СБУ

">На Харківщині відпрацьовано понад 10 можливих...</h6></a>
      <div class="cardFoot clearfix">
        <div class="cardCat">
  

    <p class="cardTime">2 mons ago </p>  

    <div class="ellipBox">
      <p class="cardEllip"></p>
    </div>
    
<p class="cardCategory">Війна</p>
         </div>
      </div>
    </div>
   
    
  </div>
  </div>    </div>
    ';
    $dropdown = '
     <div style="width:100%;z-index:500" class="dropdown-menu shadow position-absolute">
      <div class="mega-content px-4">
        <div class="">
          <div class="row">

       
 '.$cardSam.'

 '.$cardSam.'

<div class="col-md-1"></div>
            <div class="col-md-5">
              
            <ol class="list-group list-group-numbered list-group-flush">
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Subheading</div>
      Content for list item
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Subheading</div>
      Content for list item
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
      <div class="fw-bold">Subheading</div>
      Content for list item
    </div>
    <span class="badge bg-primary rounded-pill">14</span>
  </li>
</ol>
     
            </div>

          </div>
          <hr/>
        </div>
      </div>
    </div>

    ';
    ?>     
      <?php
      /*
 if(isset($block[0]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="home.php" data-bs-toggle="" data-bs-auto-close="outside">'.$block[0]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  } */
if(isset($block[1]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[1]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[1]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  if(isset($block[2]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[2]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[2]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  if(isset($block[3]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[3]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[3]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  if(isset($block[4]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[4]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[4]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  if(isset($block[5]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[5]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[5]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  if(isset($block[6]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[6]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[6]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  if(isset($block[7]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[7]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[7]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  if(isset($block[8]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[8]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[8]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  if(isset($block[9]['name'])){
  echo '
  <li class="nav-item dropdown dropdown-mega position-static '.$navHide.'">
    <a class="nav-link navLink " href="category.php?cat_id='.$block[9]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[9]['name'].'</a>
    '.$dropdown.'
  </li>
  ' ;
  }
  ?>
  <li class="nav-item dropdown dropdown-mega position-static <?php echo $navStatus ?>">
    <a class="nav-link navLink " href="city.php?id=<?php echo $city ?>&cat=headlines">Headlines</a>
  </li>
  <li class="nav-item dropdown dropdown-mega position-static <?php echo $navStatus ?>">
    <a class="nav-link navLink " href="city.php?id=<?php echo $city ?>&cat=l_a">Local authorities</a>
  </li>
  <li class="nav-item dropdown dropdown-mega position-static <?php echo $navStatus ?>">
    <a class="nav-link navLink " href="city.php?id=<?php echo $city ?>&cat=business">Business</a>
  </li>
        </ul>

      </div>
   
</nav>
 
  <!----------------------------------------------------------------------------------->
  
  </div>


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
elseif($nav_link == 'all_content.php' && isset($_GET['cat'])){
  $topCat = $_GET['cat'];
  $pageNm = $_GET['cat'];
}
elseif($nav_link == 'all_content.php' && isset($_GET['A0034'])){
  $topCat = $_GET['cat_id'];
  $pageNm = $_GET['cat_id'];
}
else{
  $topCat = 'NEWS UKRAINE';
  $pageNm = $_GET['cat'];
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
elseif($nav_link == 'category.php' && isset($_GET['cat_id']) && !isset($_GET['subcat'])){
  $topClassHome = 'text-primary border-bottom-4 border-primary';
  $topClass = 'text-dark';
}
elseif($nav_link == 'all_content.php' && !isset($_GET['subcat'])){
  $topClassHome = 'text-primary border-bottom-4 border-primary';
  $topClass = 'text-dark';
}
else{
  $topClass = 'text-dark';
  $topClassHome = 'text-dark';
}

  
$nav = $_SERVER['PHP_SELF'];
$nav_link = basename($nav);
if($nav_link == 'category.php'){
    $subNavCont = "?cat=".$_GET['cat_id'];
}
else{
    $subNavCont = "";
}

if($nav_link == 'category.php'){
  $homeNavCont = "category.php?cat_id=".$_GET['cat_id'];
}
elseif(isset($_GET['cat_id'])){
  $homeNavCont = "category.php?cat_id=".$_GET['cat_id'];
}
elseif(isset($_GET['subcat'])){
  $homeNavCont = "category.php?cat_id=".$_GET['cat_id'];
}
else{
  $homeNavCont = "home.php";
}
if(isset($_GET['page'])){
 $myPg = $_GET['page'];
}
else{
  $myPg = "";
}
if($nav_link == 'interview.php' || $nav_link == 'voices.php'|| $nav_link == 'video.php' || $nav_link == 'all_content.php' && $myPg != 'home' || $myPg != ''){
    if(!isset($_GET['cat_id'])){
        $subNavCont = "";
    }
    else{
        $subNavCont = "?cat_id=".$_GET['cat_id'];
        $topCat = ucfirst($_GET['cat_id']);
      //  $subTit = ucfirst($_GET['cat']);
    }
    if(isset($_GET['city'])){
    $subNavCont = "?city=".$_GET['city'];
    $topCat = ucfirst($_GET['city']);
    //$subTit = ucfirst($_GET['city']);
    }
    if(isset($_GET['subcat'])){
      $subNavCont = "?cat_id=".$_GET['cat_id'];
      $topCat = ucfirst($_GET['cat_id']);
      $subTit = ucfirst($_GET['subcat']);
      }
    
}
if($nav_link == 'city.php'){
    $subNavCont = "?city=".$_GET['id'];
    $topCat = ucfirst($_GET['id']);
   // $subTit = ucfirst($_GET['id']);
}





if(isset($subTit)){
    $titSytle = "margin-top: 8px;margin-bottom:0px; line-height:0.74";
    $titCont = '<br/>
<tx style="margin-bottom:-30px; font-size:15px" class="text-muted">'.$subTit.'</tx>';
}
else{
     $titSytle = "margin-top: 15px";
    $titCont = '';
}
?>

<h3 style="<?php echo $titSytle  ?>" class="text-primary pageCat pb-0"><?php echo $topCat ?><?php echo $titCont ?>
</h3>

<div <?php echo $topHide ?> class="navbarBottom b-4">
<ul class="nav">

  <li class="nav-item">
    <a class="nav-link navLink  text-secondary" href="#">My Channel</a>
  </li>
    <?php
    if(isset($_GET['cat_id'])){
     $stmt = $conn->prepare("SELECT *, sub_cat.name AS subcat FROM sub_cat LEFT JOIN category ON sub_cat.category=category.id WHERE category.name=N'".$_GET['cat_id']."'");
$stmt->execute();
$sub_cats = $stmt->fetchAll();
foreach($sub_cats as $row){
  if(isset($_GET['subcat'])){
    if($_GET['subcat'] == $row['subcat']){
    $topClassSubcat = 'text-primary border-bottom-4 border-primary';
  }else{
    $topClassSubcat = 'text-dark';
  }
  }else{
    $topClassSubcat = 'text-dark';
  }

  echo '
  <li class="nav-item">
  <a class="nav-link navLink '.$topClassSubcat.'" href="all_content.php?subcat='.$row['subcat'].'&cat_id='.$_GET['cat_id'].'">'.$row['subcat'].'</a>
</li>
  ';
}   
    }

//echo "<script>alert('".$subNavCont."')</script>";
  ?>
  <li class="nav-item">
    <a class="nav-link navLink  <?php echo $topClassHome ?>" href="<?php echo $homeNavCont ?>">Headlines</a>
  </li>
  <li class="nav-item">
    <a class="nav-link navLink  <?php echo $topClassInterview ?>" href="interview.php<?php echo $subNavCont ?>">Interviews</a>
  </li>
  <li class="nav-item ">
    <a class="nav-link navLink  <?php echo $topClassVoice ?>"  href="voices.php<?php echo $subNavCont ?>">Voices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link navLink  <?php echo $topClassVideo ?>" href="video.php<?php echo $subNavCont ?>">Videos</a>
  </li>
  
</ul>

</div>


        </div>
   
<div <?php echo $topHide ?> class="col-md-3 mt-2">

 
<ul class="nav nav-fill justify-content-end feedbackRow">
  <li class="nav-item">
    <a class="nav-link navLink text-dark" href="#">Feedback Here</a>
  </li>
  <li class="nav-item">
    <a class="nav-link navLink text-dark" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
  </li>
</ul>

<h3 class="text-primary pageDesc text-dark">"All daily news it matters from trustful sources"</h3>

<div style="font-size: 12px; margin-bottom:-15px;" class="d-flex justify-content-between w-100 pt-2 pe-3">
<i style="margin-left:-49px" class="fa fa-heart text-danger text-start pt-1"></i>
<div class="text-start">
<b>Free</b> to ad: Press releases - jobs -Events -Ads
</div>
</div>
        </div>
        
    </div>
    
    <hr <?php echo $topHide ?> class="navbarHr">     
    
   
</div>