<?php
  
  $total_panel = $wanted_panels - 1;
  for ($mn = 1; $mn <= $total_panel; $mn++) {
    echo '<div class="row"><div class="row">';
    $panel_low = $mn * 8;
    if ($mn != $total_panel) {
      $panel_high = 8;
    } else {
      $panel_high = 7;
    }

    $block_news_2 = array_slice($block_news, $panel_low, $panel_high);

    foreach ($block_news_2 as $row) {
  echo ukrzmiCard($row, $block, $block_id);
    }

    if ($panel_high == 8) {
      echo '</div></div>';
    } else {
        $attr1 = ".lastCard".$block[$block_id]['id'];
        $attr2 = "carNext".$block[$block_id]['id'];
        $attr3 = "carNext".$block[$block_id]['id'];
    echo '
    
      <div class="col-md-3 lastCard'.$block[$block_id]['id'].'">
        <div class="card col-sm-4 col-md-3 newsCard" style="background-color:'.$block[$block_id]['bg_color'].'">
          <div class="card-content">
            <div class="card-body d-flex justify-content-center h-75">
              <div class="m-auto border border-dark rounded p-2 border-2 fw-bold fs-5">
                <tx class="text-dark text-center">Read all headlines</tx>
              </div>
              <a class="stretched-link" href="all_content.php?page='.$pageName.'&block_id='.$block_id.'&cat_id='.$block[$block_id]['name'].'&cat_type='.$block[$block_id]['type'].'"></a>
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


      const box'.$block[$block_id]['id'].' = document.querySelector("'.$attr1.'");

      setInterval(function() {
       const messageText = isInViewport(box'.$block[$block_id]['id'].') ?
      "viewed" :
      "notViewed";

       if (messageText == "viewed") {
      // alert(messageText);
        document.getElementById("'.$attr2.'").style.visibility = "hidden";
      } else if (messageText == "notViewed") {
        document.getElementById("'.$attr2.'").style.visibility = "";
      }

      }, 10);
     </script>
     </div>
     ';
    }
   
  }
?>
