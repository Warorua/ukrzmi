<?php
include 'includes/header.php';
include ('full_coverage/vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
use \NlpTools\Similarity\CosineSimilarity;
 $tok = new WhitespaceTokenizer();
$fc_algorithm = new CosineSimilarity();

?>
<style>

#mixedSlider {
  position: relative;
}
#mixedSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 5%;
  margin-top: 30px;
  margin-bottom: -10px;
}
#mixedSlider .MS-content .item {
  display: inline-block;
  width: 25%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  padding: 0 10px;
}
@media (max-width: 991px) {
  #mixedSlider .MS-content .item {
    width: 50%;
  }
}
@media (max-width: 767px) {
  #mixedSlider .MS-content .item {
    width: 100%;
  }
}


#mixedSlider .MS-content .item  img {
  height: 120px;
  width: 100%;
}
#mixedSlider .MS-content .item p {
  font-size: 16px;
  margin: 2px 10px 0 5px;
  text-indent: 15px;
}
#mixedSlider .MS-content .item a {
  float: right;
  margin: 0 20px 0 0;
  font-size: 16px;
  color: rgba(0, 0, 0, 0.9);
  font-weight: bold;
  letter-spacing: 1px;
  transition: linear 0.1s;
}
#mixedSlider .MS-content .item a:hover {
  text-shadow: 0 0 1px grey;
}
#mixedSlider .MS-controls button {
  position: absolute;
  border: none;
  background-color: transparent;
  outline: 0;
  font-size: 30px;
  top: 60px;
  color: rgba(0, 0, 0, 0.4);
  transition: 0.15s linear;
}
#mixedSlider .MS-controls button:hover {
  color: rgba(0, 0, 0, 0.8);
}
@media (max-width: 992px) {
  #mixedSlider .MS-controls button {
    font-size: 30px;
  }
}
@media (max-width: 767px) {
  #mixedSlider .MS-controls button {
    font-size: 20px;
  }
}
#mixedSlider .MS-controls .MS-left {
  left: 0px;
}
@media (max-width: 767px) {
  #mixedSlider .MS-controls .MS-left {
    left: -10px;
  }
}
#mixedSlider .MS-controls .MS-right {
  right: 0px;
}
@media (max-width: 767px) {
  #mixedSlider .MS-controls .MS-right {
    right: -10px;
  }
}
#basicSlider { position: relative; }

#basicSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 2%;
  height: 50px;
}

#basicSlider .MS-content .item {
  display: inline-block;
  width: 20%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  line-height: 50px;
  vertical-align: middle;
}
@media (max-width: 991px) {

#basicSlider .MS-content .item { width: 25%; }
}
@media (max-width: 767px) {

#basicSlider .MS-content .item { width: 35%; }
}
@media (max-width: 500px) {

#basicSlider .MS-content .item { width: 50%; }
}

#basicSlider .MS-content .item a {
  line-height: 50px;
  vertical-align: middle;
}

#basicSlider .MS-controls button { position: absolute; }

#basicSlider .MS-controls .MS-left {
  top: 35px;
  left: 10px;
}

#basicSlider .MS-controls .MS-right {
  top: 35px;
  right: 10px;
}
</style>
<body>
    <div id="hideTop">
<?php
include 'home/blocks.php';
include 'videos/auth.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
</div>
<div id="myBody" class="newsContainer">
    <div class="row homeContent">
    
        <div id="showSpace" class="col-md-9 catColumn">
<div class="row">
<?php
include 'videos/title_row.php';
include 'videos/img_row.php';
?>
<div class="col-md-12 mt-0">
<?php
include 'videos/headlines/grid_video.php';
?>
</div>
 
    <div style="margin-bottom:10px" class="col-md-12">   <hr/></div>
<div class="col-md-8">
<div class="row">

    <div class="col-md-12">   <hr style="color:white"/></div>      

    <div class="col-md-8 catTool">
  <ul class="nav justify-content-start">
  <li class="nav-item">
    <a class="nav-link disabled"><i class="fa fa-tags" aria-hidden="true"></i></a>
  </li>

  <li class="nav-item">
    <a class="nav-link text-secondary" href="tag.php?tag_id=<?php echo $data['tag_1'] ?>"><?php echo $data['tag_1'] ?></a>
  </li>

  <li class="nav-item">
    <a class="nav-link text-secondary" href="tag.php?tag_id=<?php echo $data['tag_2'] ?>"><?php echo $data['tag_2'] ?></a>
  </li>

  <li class="nav-item">
    <a class="nav-link text-secondary" href="tag.php?tag_id=<?php echo $data['tag_3'] ?>"><?php echo $data['tag_3'] ?></a>
  </li>
  
</ul>   
</div>
<div class="col-md-4 catTool">
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link text-secondary">
    <i id="resettext" class="fa fa-undo" aria-hidden="true"></i>
    <i id="decreasetext" class="fa fa-font" aria-hidden="true"></i>
    <i id="increasetext" class="fa fa-font fa-lg" aria-hidden="true"></i>
    </a>
  </li>
  <li id="testHide" class="nav-item">
    <a class="nav-link">
        <i id="lightOff" class="fa fa-lightbulb-o fa-lg text-warning"></i>
        <i id="lightOn" class="fa fa-lightbulb-o fa-lg text-dark"></i>
    </a>
  </li>

</ul>
 </div>

 <div style="font-size: 13px;" class="col-md-12">
 <ul class="nav">
  <li class="nav-item">
    <a class="nav-link disabled">
    <i  style="margin-right:10px" class="fa fa-clock-o" aria-hidden="true"></i>  2 Minutes
    </a>
  </li>
</ul>
 </div>

  <div id="cardContent" class="col-md-12 article_content">
 <?php echo closetags($article) ?>

 <div class="mt-4">
   <div class="row">
       <div class="col-md-12 mt-3">
 <a href="<?php echo $data['deep_link'] ?>" target="_blank">Read article from the source</a>
       </div>
       <div class="col-md-12 mt-3">
<a href="full_coverage.php?id=<?php echo $data['id'] ?>" target="_blank">Get full coverage</a>
       </div>
       <div class="col-md-11"></div>
       <div class="col-md-1 mt-3">
           <div class="justify-content-end">
            <a type="button" class="justify-content-end" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-share-alt fa-lg" aria-hidden="true"></i>
        </a>  
                <ul class="dropdown-menu">
         <li><h6 class="dropdown-header">Share</h6></li>
          <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/video_content.php?code=<?php echo $data['code'] ?>" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
          <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/video_content.php?code=<?php echo $data['code'] ?>" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
          <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/video_content.php?code=<?php echo $data['code'] ?>" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
          <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/video_content.php?code=<?php echo $data['code'] ?>&media=https://www.ukrzmi.com/images/<?php echo $data['photo'] ?>&description=<?php echo $data['title'] ?>" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
           </ul>
        
           </div>
       

       </div>
   </div>  
 </div>
 </div>  


</div>
</div>

 <div class="col-md-4">
<div class="card catCard mt-3">
    <div class="card-content">
        <div class="card-body">
<div class="row">
    <div class="col-md-4">
    <img class="catCardImage" src="https://www.pravda.com.ua/android-chrome-192x192.png"/>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5">
        <div class="half-circle">72</div>
        <div class="text-secondary half-circle-text">Source level trust</div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-12">
        <div class="authorName">By <?php echo $data['author'] ?></div>
    </div>
    <div class="col-md-12">
        <div class="text-secondary py-2">National news agency</div>
    </div>
    <div style="margin-top:40px" class="row">
        <div class="text-dark authorScore col-md-10">Author's score: 72/40</div>

        <div class="text-dark authorScore_2 col-md-2">
        <div class="authorScore_icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="The score of author is 72">i</div>
        </div>

    </div>
    <div style="margin-top:20px" class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"><a style="width:100%" class="btn btn-primary" href="#">Follow author</a></div>
        <div class="col-md-1"></div>
    </div>
</div>

        </div>
    </div>
</div>
</div> 


</div>
<div style="margin-bottom:10px" class="col-md-12">   <hr/></div>
   <!--------------------------------------------------------------------------------------------------->
 <?php
include 'videos/eval_section.php';
?>
<div style="margin-bottom:10px" class="col-md-12">   <hr/></div>
<?php
include 'videos/comment_section.php';
?>
        </div>

        <div id="hideSpace" class="col-md-3 cardColumn_2">
        
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

<?php
include 'videos/auth_js.php';
?>


</body>