
<style>
  .slickk-next-<?php echo $block[0]['id']; ?>{
  width: 100%;
}
.slickk-prev-<?php echo $block[0]['id']; ?>{
  width: 100%;
}

</style>
<?php //echo $block[0]['name']; ?>
<h2 class="newsHead"><?php echo $block[0]['name']; ?></h2>
<div style="background-color:<?php echo $block[0]['bg_color']; ?>" class="cardBlock row carousel-<?php echo $block[0]['id']; ?>">



<div class="row">
<?php
include 'home/grid_cards.php';
?>
</div>
<div class="row">
<?php
include 'home/grid_cards.php';
?> 
</div>
<div class="row">
<?php
include 'home/grid_cards.php';
?> 
</div>
<div class="row">
<?php
include 'home/grid_cards.php';
?> 
</div>
<div class="row">
<?php
include 'home/grid_cards.php';
?> 
</div>
<div class="row">
<?php
include 'home/grid_cards.php';
?> 
</div>




</div>
<div style="background-color:<?php echo $block[0]['bg_color']; ?>" class="row cardPanel pb-2">
  <div class="col-md-9"></div>
  <div class="col-md-3 d-flex justify-content-between">
 <button id="carPrev<?php echo $block[0]['id']; ?>" type="button" data-role="" class="slickk-prev-<?php echo $block[0]['id']; ?> btn btn-outline-dark btn-sm" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Previous</button>
  
<button id="carNext<?php echo $block[0]['id']; ?>" type="button" data-role="" class="slickk-next-<?php echo $block[0]['id']; ?> btn btn-outline-dark btn-sm" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Next</button>
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

$('.carousel-<?php echo $block[0]['id']; ?>').on('init',function(event, slick){
  document.getElementById('carPrev<?php echo $block[0]['id']; ?>').style.visibility = 'hidden';
});

// On before slide change
$('.carousel-<?php echo $block[0]['id']; ?>').on('afterChange', function(event, slick, currentSlide){
  
  let CarNo = $('.carousel-<?php echo $block[0]['id']; ?>').slick('slickCurrentSlide');
  //alert('['+ CarNo+']');
  if (CarNo==0) {
    //alert('this is page 0')
    document.getElementById('carPrev<?php echo $block[0]['id']; ?>').style.visibility = 'hidden';
  }
  else if(CarNo!=0){
    document.getElementById('carPrev<?php echo $block[0]['id']; ?>').style.visibility = '';
  }
  if (CarNo==8) {
    //alert('this is page 0')
    document.getElementById('carNext<?php echo $block[0]['id']; ?>').style.visibility = 'hidden';
  }
  else if(CarNo!=8){
    document.getElementById('carNext<?php echo $block[0]['id']; ?>').style.visibility = '';
  }


});

$('.slickk-prev-<?php echo $block[0]['id']; ?>').click(function(e){ 
      	//e.preventDefault(); 
		$('.carousel-<?php echo $block[0]['id']; ?>').slick('slickPrev');
	} );
	
	$('.slickk-next-<?php echo $block[0]['id']; ?>').click(function(e){
		//e.preventDefault(); 
		$('.carousel-<?php echo $block[0]['id']; ?>').slick('slickNext');
	} );  


$('.carousel-<?php echo $block[0]['id']; ?>').slick(slickopts);
</script>


