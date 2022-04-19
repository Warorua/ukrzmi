<?php
include 'includes/header.php';

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
  top: 110px;
  color: rgba(0, 0, 0, 0.4);
  transition: 0.15s linear;
}
#mixedSlider .MS-controls button:hover {
  color: rgba(0, 0, 0, 0.8);
}


#mixedSlider .MS-controls .MS-left {
  left: 0px;
}

#mixedSlider .MS-controls .MS-right {
  right: 0px;
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
.titleBadge{
  width:20px!important;
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
<div id="myBody" class="">
    <div class="row">
    
        <div id="showSpace" class="col-md-12">
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
 
    <div class="col-md-12">   <hr/></div>
<div class="catContent m-1">

   

<div style="font-size: 13px;" class="d-flex justify-content-between p-2">
 <tx>By : <b><?php echo $data['author'] ?></b></tx>
<div>(2m read)</div>
<a class="btn btn-primary btn-sm">Follow author</a>
 </div>


  <div id="cardContent" class="col-md-12 article_content">
 <?php echo closetags($article) ?>
 </div>  
 <div class="d-flex justify-content-between">
   <div class="w-50 d-flex justify-content-center">
     <a class="btn btn-outline-dark" href="<?php echo $data['deep_link'] ?>">Read the article at the source</a>
   </div>
   
   <div class="w-50 d-flex justify-content-center">
     <a class="btn btn-outline-dark" href="full_coverage.php?id=<?php echo $data['id'] ?>"><b>Full coverage</b><br/>Read other sources</a>
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