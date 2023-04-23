<?php
include 'includes/header.php';

?>
<body>
    
    <?php include_once("analyticstracking.php") ?>
    
    <div id="hideTop">
<?php
include 'home/blocks.php';
include 'content/auth.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
</div>
<div id="myBody" class="">
    <div class="container">
    
        <div id="showSpace" class="col-md-12">
<div class="row">
<?php
include 'content/title_row.php';
include 'content/img_row.php';
?>
<div class="catContent">


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
<div class="d-flex justify-content-center w-100">
  <img class="w-75" src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/0d28fd84552527.5d602a4f870e5.jpg"/>
</div>
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
include 'content/auth_js.php';
?>


</body>