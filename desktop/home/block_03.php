
<style>
  .slickk-next-<?php echo $block[2]['name']; ?>{
  width: 100%;
}
.slickk-prev-<?php echo $block[2]['name']; ?>{
  width: 100%;
}

</style>
<?php //echo $block[2]['name']; ?>
<h2 class="newsHead"><?php echo $block[2]['name']; ?></h2>
<div style="background-color:<?php echo $block[2]['bg_color']; ?>" class="cardBlock row carousel-<?php echo $block[2]['name']; ?>">





<div class="row">
<?php
$block_id = 2;
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
<div style="background-color:<?php echo $block[2]['bg_color']; ?>" class="row cardPanel pb-2">
 <div class="col-md-9"></div>
  <div class="col-md-3 d-flex justify-content-center">
 <button id="carPrev<?php echo $block[2]['name']; ?>" type="button" data-role="" class="slickk-prev-<?php echo $block[2]['name']; ?> btn btn-outline-dark btn-sm" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Previous</button>
  
<button id="carNext<?php echo $block[2]['name']; ?>" type="button" data-role="" class="slickk-next-<?php echo $block[2]['name']; ?> btn btn-outline-dark btn-sm" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Next</button>
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
    responsive: [
    { breakpoint: 992,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
  arrows: false,
      }
    },
    
    ]
};

$('.carousel-<?php echo $block[2]['name']; ?>').on('init',function(event, slick){
  document.getElementById('carPrev<?php echo $block[2]['name']; ?>').style.display = 'none';
});

// On before slide change
$('.carousel-<?php echo $block[2]['name']; ?>').on('afterChange', function(event, slick, currentSlide){
  
  let CarNo = $('.carousel-<?php echo $block[2]['name']; ?>').slick('slickCurrentSlide');
  //alert('['+ CarNo+']');
  if (CarNo==0) {
    //alert('this is page 0')
    document.getElementById('carPrev<?php echo $block[2]['name']; ?>').style.display = 'none';
  }
  else if(CarNo!=0){
    document.getElementById('carPrev<?php echo $block[2]['name']; ?>').style.display = '';
  }
  if (CarNo==<?php echo $slide_control; ?>) {
    //alert('this is page 0')
    document.getElementById('carNext<?php echo $block[2]['name']; ?>').style.display = 'none';
  }
  else if(CarNo!=<?php echo $slide_control; ?>){
    document.getElementById('carNext<?php echo $block[2]['name']; ?>').style.display = '';
  }


});

$('.slickk-prev-<?php echo $block[2]['name']; ?>').click(function(e){ 
      	//e.preventDefault(); 
		$('.carousel-<?php echo $block[2]['name']; ?>').slick('slickPrev');
	} );
	
	$('.slickk-next-<?php echo $block[2]['name']; ?>').click(function(e){
		//e.preventDefault(); 
		$('.carousel-<?php echo $block[2]['name']; ?>').slick('slickNext');
	} );  


$('.carousel-<?php echo $block[2]['name']; ?>').slick(slickopts);
</script>


