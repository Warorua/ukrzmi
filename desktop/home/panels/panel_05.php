<div class="row">
  <?php

  $block_news_5 = array_slice($block_news, 32, 7);

  foreach ($block_news_5 as $row) {
    $catHolder = blockAux($row)['catHolder'];
    $lastPos = blockAux($row)['lastPos'];
    $rowtitle = blockAux($row)['rowtitle'];
    $filtTit = blockAux($row)['filtTit'];
    $frameColor = blockAux($row)['frameColor'];
    $titleBadge = blockAux($row)['titleBadge'];

    echo articleCard($row, $block, $block_id, $frameColor, $filtTit, $titleBadge, $rowtitle, $catHolder);
  }

  //for ($x = 0; $x <= 48; $x++) {}
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