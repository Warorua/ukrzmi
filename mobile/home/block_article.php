
<style>
  .slickk-next-<?php echo $block[1]['name']; ?>{
  width: 100%;
}
.slickk-prev-<?php echo $block[1]['name']; ?>{
  width: 100%;
}
.cardSet{
    background-color: rgba(255, 255, 255, 0)!important;
}
.cardHr{
    background-color: rgba(255, 255, 255, 0)!important;
    display: none;
}
</style>
<?php //echo $block[1]['name']; ?>
<h5 class="newsHead mb-4 text-primary">You may also like to read</h5>
<div class="cardBlock carousel-<?php echo $block[1]['name']; ?>">




<div class="row">
<?php
$block_id = 1;
include 'home/panels/panel_01.php';
?>
</div>

<div class="row">
<?php
include 'home/panels/panel_02.php';
?>
</div>

<div class="row">
<?php
include 'home/panels/panel_03.php';
?>
</div>

<div class="row">
<?php
include 'home/panels/panel_04.php';
?>
</div>

<div class="row">
<?php
include 'home/panels/panel_05.php';
?>
 </div> 
 <div class="row">
<?php
include 'home/panels/panel_06.php';
?>
 </div> 








  
</div>
<div class="cardBlock container">
  <div class="d-flex justify-content-between">
   <button id="carPrev<?php echo $block[1]['name']; ?>" type="button" data-role="" class="slickk-prev-<?php echo $block[1]['name']; ?> btn btn-outline-dark btn-sm w-25" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Previous</button>
  <button id="carNext<?php echo $block[1]['name']; ?>" type="button" data-role="" class="slickk-next-<?php echo $block[1]['name']; ?> btn btn-outline-dark btn-sm w-25" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Next</button>
  </div>
 
  
</div>
<script>
    
    var slickopts = {
  slidesToShow: 1,
  slidesToScroll: 1,
  loop: false,
  swipe:false,
  infinite: false,
  arrows: false,
  // prev arrow
  //prevArrow:'<button type="button" id="prevBtn" data-role="none" class="slick-prev btn btn-primary">Previous</button>',
  // next arrow
  //nextArrow:'<button type="button" id="nxtBtn" data-role="none" class="slick-next btn btn-primary">Next</button>',
  rows: 1, // Removes the linear order. Would expect card 5 to be on next row, not stacked in groups.
  
};

$('.carousel-<?php echo $block[1]['name']; ?>').on('init',function(event, slick){
  document.getElementById('carPrev<?php echo $block[1]['name']; ?>').style.display = 'none';
});

// On before slide change
$('.carousel-<?php echo $block[1]['name']; ?>').on('afterChange', function(event, slick, currentSlide){
  
  let CarNo = $('.carousel-<?php echo $block[1]['name']; ?>').slick('slickCurrentSlide');
  //alert('['+ CarNo+']');
  if (CarNo==0) {
    //alert('this is page 0')
    document.getElementById('carPrev<?php echo $block[1]['name']; ?>').style.display = 'none';
  }
  else if(CarNo!=0){
    document.getElementById('carPrev<?php echo $block[1]['name']; ?>').style.display = '';
  }
  if (CarNo==<?php echo $slide_control; ?>) {
    //alert('this is page 0')
    document.getElementById('carNext<?php echo $block[1]['name']; ?>').style.display = 'none';
  }
  else if(CarNo!=<?php echo $slide_control; ?>){
    document.getElementById('carNext<?php echo $block[1]['name']; ?>').style.display = '';
  }


});

$('.slickk-prev-<?php echo $block[1]['name']; ?>').click(function(e){ 
      	//e.preventDefault(); 
		$('.carousel-<?php echo $block[1]['name']; ?>').slick('slickPrev');
	} );
	
	$('.slickk-next-<?php echo $block[1]['name']; ?>').click(function(e){
		//e.preventDefault(); 
		$('.carousel-<?php echo $block[1]['name']; ?>').slick('slickNext');
	} );  


$('.carousel-<?php echo $block[1]['name']; ?>').slick(slickopts);
</script>


