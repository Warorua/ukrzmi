<?php
include 'includes/header.php';

?>
<body class="">
    
    <?php include_once("analyticstracking.php") ?>
    
<?php
include 'home/blocks.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
<div id="myBody" class="newsContainer">
    <div class="row homeContent">
        <div id="showSpace" class="col-md-9 col-lg-9 col-xl-9 cardColumn">
        <?php
include 'tag/body.php';
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
<script type="text/javascript" src="../bower/js/jquery-3.6.0.js"></script>
<script>
   $('#lightOff').css('display', 'none');
  $('#lightOn').click(function() {
    $('#lightOff').css('display', '');
    $('#lightOn').css('display', 'none');
    document.getElementById('showSpace').className += ' showSpace';
    document.getElementById('hideSpace').className += ' hideSpace';
  
    document.getElementsById('myBody').className += ' bg-dark';
    
    
	});
  $('#lightOff').click(function() {
    $('#lightOff').css('display', 'none');
    $('#lightOn').css('display', '');
    document.getElementById('showSpace').classList.remove('showSpace');
    document.getElementById('hideSpace').classList.remove('hideSpace');
    
    document.getElementsById('myBody').classList.remove('bg-dark');
    
	});
	

</script>
</body>