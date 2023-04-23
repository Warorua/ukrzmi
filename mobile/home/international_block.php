<style>
    <?php
for ($x = 0; $x <= 30; $x++) {
$perc = ($x * 100)-100;
    echo '
    .carousel_int > input:nth-of-type('.$x.'):checked ~ .carousel_int__slides .carousel_int__slide:first-of-type {
        margin-left: -'.$perc.'%;
      }
      .carousel_int > input:nth-of-type('.$x.'):checked ~ .carousel_int__thumbnails li:nth-of-type('.$x.') {
        box-shadow: 0px 0px 0px 5px rgba(0, 0, 255, 0.5);
      }
    ';
}
    ?>
</style>
<section>
    <?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM news WHERE category=:category AND NOT title=:title LIMIT 24");
$stmt->execute(['category'=>'international', 'title'=>'']);
$intern_block = $stmt->fetchAll();
    ?>
<h2 class="newsHead">Top International Headlines</h2>
    <div class="container">
        <div class="carousel_int">
      <div class="">
    <ul class="nav">
  <li class="nav-item">
    <a class="nav-link navLink active" aria-current="page" href="#">About Ukraine</a>
  </li>
  <li class="nav-item">
    <a class="nav-link navLink" href="#">Headlines</a>
  </li>
  <li class="nav-item">
    <a class="nav-link navLink" href="#">Original Language</a>
  </li>
</ul>
    </div>          
 <div class="row "> 
                 <div class="col-md-6 carousel_int">
         
            <?php
foreach($intern_block as $row){
    echo ' <input class="caroRadio" type="radio" name="slides" id="slide-'.$row['id'].'">
    ';
}
              ?>
    <ul class="carousel_int__slides">
 
                <?php
foreach($intern_block as $row){
    echo '
                 <li class="carousel_int__slide">
                    <figure>
                        <div class="imgTitle">
                            <img src="https://www.ukrzmi.com/images/'.$row['photo'].'" alt="">
                        
                            <p class="blogTitleInt clearfix">
                          
                        '.$row['category'].'
                                                     
                        </p> </div>
                    </figure>
                </li>
    ';
}
              ?>
            </ul>   

  </div>              
<div class="col-md-6 carousel_int">

          <ul class="carousel_int__thumbnails">
              <?php
foreach($intern_block as $row){
    echo '
       <li>
                    <label id="internIter'.$row['id'].'" for="slide-'.$row['id'].'">              
<div class="d-flex justify-content-between">
<div><img class="interImage" src="https://www.pravda.com.ua/android-chrome-192x192.png"/></div>
<div class="carousel_title"><div class="float-start">'.$row['title'].'</div></div>                  
</div>
      
                    </label>
                </li>
  
    ';
}
              ?>
             
            </ul> 
            
 <div style="margin-top:10px" class="container">

  <div class="d-flex justify-content-between">
 <button id="carPrevinternational" type="button" data-role="" class="slickk-prev-international btn btn-dark btn-sm w-25" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Previous</button>
<button id="carNextinternational" type="button" data-role="" class="slickk-next-international btn btn-dark btn-sm w-25" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Next</button>
  </div>
 
  
</div>

                </div>

       
            </div>
  

            
        </div>
    </div>
</section>
<script>
(function ($) {
  $(function () {


    $('.carousel_int__thumbnails').slick({
    dots:false,
    arrows:false,
    infinite: false,
  slidesToShow: 1,
rows: 6,
autoplay: true,
  autoplaySpeed: 29000,
    });


  });
})(jQuery);

////////////////////////////////////////////
$('.carousel_int__thumbnails').on('afterChange',function(event, slick, currentSlide){
  // do something
 // alert(currentSlide);
});


//////////////////////////////////////////////
$('.carousel_int__thumbnails').on('init',function(event, slick){
  document.getElementById('carPrevinternational').style.display = 'none';
});

// On before slide change
$('.carousel_int__thumbnails').on('afterChange', function(event, slick, currentSlide){
  
  let CarNo = $('.carousel_int__thumbnails').slick('slickCurrentSlide');
  //alert('['+ CarNo+']');
  if (CarNo==0) {
    //alert('this is page 0')
    document.getElementById('carPrevinternational').style.display = 'none';
  }
  else if(CarNo!=0){
    document.getElementById('carPrevinternational').style.display = '';
  }
  if (CarNo==3) {
    //alert('this is page 0')
    document.getElementById('carNextinternational').style.display = 'none';
  }
  else if(CarNo!=3){
    document.getElementById('carNextinternational').style.display = '';
  }

});

$('.slickk-prev-international').click(function(e){ 
      	//e.preventDefault(); 
		$('.carousel_int__thumbnails').slick('slickPrev');
	} );
	
	$('.slickk-next-international').click(function(e){
		//e.preventDefault(); 
		$('.carousel_int__thumbnails').slick('slickNext');
	} );  

</script>
<script>
 <?php
foreach($intern_block as $row){
 $click_iter =  array_search($row['id'], array_column($intern_block, 'id'))*5000;
 $click_iter_m = $click_iter+4500;
    echo '
    setInterval(() => {
      document.getElementById("internIter'.$row['id'].'").style.color = "blue";
      document.getElementById("internIter'.$row['id'].'").click();
     
  },'.$click_iter.');

  setInterval(() => {   
    document.getElementById("internIter'.$row['id'].'").style.color = "black";
     document.getElementById("internIter'.$row['id'].'").removeAttribute("id");
},'.$click_iter_m.');
  ';
}
              ?>
</script>
