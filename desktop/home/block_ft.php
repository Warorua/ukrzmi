<?php

?>
<style>
  .slickk-next-<?php echo $block[$block_id]['name']; ?> {
    width: 100%;
  }

  .slickk-prev-<?php echo $block[$block_id]['name']; ?> {
    width: 100%;
  }
</style>
<?php //echo $block[$block_id]['name']; 
?>
<h2 class="newsHead"><?php echo $block[$block_id]['name']; ?></h2>
<div style="background-color:<?php echo $block[$block_id]['bg_color']; ?>" class="cardBlock row carousel-<?php echo $block[$block_id]['name']; ?>">





  <div class="row">
    <?php
    //$block[$block_id] = 9;
    include 'home/panels/panel_01.php';
    ?>
  </div>


  
  <?php
  $wanted_panels = 5;

  $total_panel = $wanted_panels - 1;
  for ($i = 1; $i <= $total_panel; $i++) {
    echo '<div class="row"><div class="row">';
    $panel_low = $i * 8;
    if ($i != $total_panel) {
      $panel_high = 8;
    } else {
      $panel_high = 7;
    }

    $block_news_2 = array_slice($block_news, $panel_low, $panel_high);

    foreach ($block_news_2 as $row) {
      $catHolder = blockAux($row)['catHolder'];
      $lastPos = blockAux($row)['lastPos'];
      $rowtitle = blockAux($row)['rowtitle'];
      $filtTit = blockAux($row)['filtTit'];
      $frameColor = blockAux($row)['frameColor'];
      $titleBadge = blockAux($row)['titleBadge'];
      echo articleCard($row, $block, $block_id, $frameColor, $filtTit, $titleBadge, $rowtitle, $catHolder);
    }

    if ($panel_high == 8) {
      echo '</div>';
    } else {
  ?>
      <div class="col-md-3 lastCard<?php echo $block[$block_id]['id']; ?>">
        <div class="card col-sm-4 col-md-3 newsCard" style="background-color:<?php echo $block[$block_id]['bg_color'] ?>">
          <div class="card-content">
            <div class="card-body d-flex justify-content-center h-75">
              <div class="m-auto border border-dark rounded p-2 border-2 fw-bold fs-5">
                <tx class="text-dark text-center">Read all headlines</tx>
              </div>
              <a class="stretched-link" href="all_content.php?page=<?php echo $pageName ?>&block_id=<?php echo $block_id ?>&cat_id=<?php echo $block[$block_id]['name'] ?>&cat_type=<?php echo $block[$block_id]['type'] ?>"></a>
            </div>
          </div>
        </div>
      </div>
</div>

<script>
  function isInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)

    );
  }


  const box<?php echo $block[$block_id]['id']; ?> = document.querySelector('.lastCard<?php echo $block[$block_id]['id']; ?>');

  setInterval(function() {
    const messageText = isInViewport(box<?php echo $block[$block_id]['id']; ?>) ?
      'viewed' :
      'notViewed';

    if (messageText == 'viewed') {
      // alert(messageText);
      document.getElementById('carNext<?php echo $block[$block_id]['id']; ?>').style.visibility = 'hidden';
    } else if (messageText == 'notViewed') {
      document.getElementById('carNext<?php echo $block[$block_id]['id']; ?>').style.visibility = '';
    }


    //alert(messageText);

  }, 10);
</script>
<?php
    }
    echo '</div>';
  }
?>



<!---
<div class="row">
  <?php
 // include 'home/panels/panel_02.php';
  ?>
</div>



<div class="row">
  <?php
  //include 'home/panels/panel_02.php';
  ?>
</div>

<div class="row">
  <?php
//  include 'home/panels/panel_03.php';
  ?>
</div>

<div class="row">
  <?php
 // include 'home/panels/panel_04.php';
  ?>
</div>

<div class="row">
  <?php
 // include 'home/panels/panel_05.php';
  ?>
</div>
<div class="row">
  <?php
//  include 'home/panels/panel_06.php';
  ?>
</div>
--->








</div>
<div style="background-color:<?php echo $block[$block_id]['bg_color']; ?>" class="row cardPanel pb-2">
  <div class="col-md-9"></div>
  <div class="col-md-3 d-flex justify-content-between">
    <button id="carPrev<?php echo $block[$block_id]['id']; ?>" type="button" data-role="" class="slickk-prev-<?php echo $block[$block_id]['name']; ?> btn btn-outline-dark btn-sm" <?php if (isset($hide_control_button)) {
                                                                                                                                                                                      echo $hide_control_button;
                                                                                                                                                                                    } ?>>Previous</button>

    <button id="carNext<?php echo $block[$block_id]['id']; ?>" type="button" data-role="" class="slickk-next-<?php echo $block[$block_id]['name']; ?> btn btn-outline-dark btn-sm" <?php if (isset($hide_control_button)) {
                                                                                                                                                                                      echo $hide_control_button;
                                                                                                                                                                                    } ?>>Next</button>
  </div>


</div>
<script>
  var slickopts = {
    slidesToShow: 1,
    slidesToScroll: 1,
    loop: false,
    swipe: false,
    infinite: false,
    arrows: false,
    // prev arrow
    //prevArrow:'<button type="button" id="prevBtn" data-role="none" class="slick-prev btn btn-primary">Previous</button>',
    // next arrow
    //nextArrow:'<button type="button" id="nxtBtn" data-role="none" class="slick-next btn btn-primary">Next</button>',
    rows: 1, // Removes the linear order. Would expect card 5 to be on next row, not stacked in groups.
    responsive: [{
        breakpoint: 992,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: false,
          arrows: false,
        }
      },

    ]
  };

  $('.carousel-<?php echo $block[$block_id]['name']; ?>').on('init', function(event, slick) {
    document.getElementById('carPrev<?php echo $block[$block_id]['id']; ?>').style.visibility = 'hidden';
  });

  // On before slide change
  $('.carousel-<?php echo $block[$block_id]['name']; ?>').on('afterChange', function(event, slick, currentSlide) {

    let CarNo = $('.carousel-<?php echo $block[$block_id]['name']; ?>').slick('slickCurrentSlide');
    //alert('['+ CarNo+']');
    if (CarNo == 0) {
      //alert('this is page 0')
      document.getElementById('carPrev<?php echo $block[$block_id]['id']; ?>').style.visibility = 'hidden';
    } else if (CarNo != 0) {
      document.getElementById('carPrev<?php echo $block[$block_id]['id']; ?>').style.visibility = '';
    }
    if (CarNo == <?php echo $slide_control; ?>) {
      //alert('this is page 0')
      document.getElementById('carNext<?php echo $block[$block_id]['id']; ?>').style.visibility = 'hidden';
    } else if (CarNo != <?php echo $slide_control; ?>) {
      document.getElementById('carNext<?php echo $block[$block_id]['id']; ?>').style.visibility = '';
    }


  });

  $('.slickk-prev-<?php echo $block[$block_id]['name']; ?>').click(function(e) {
    //e.preventDefault(); 
    $('.carousel-<?php echo $block[$block_id]['name']; ?>').slick('slickPrev');
  });

  $('.slickk-next-<?php echo $block[$block_id]['name']; ?>').click(function(e) {
    //e.preventDefault(); 
    $('.carousel-<?php echo $block[$block_id]['name']; ?>').slick('slickNext');
  });


  $('.carousel-<?php echo $block[$block_id]['name']; ?>').slick(slickopts);
</script>