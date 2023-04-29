<div class="row">
  <div class="col-md-3 <?php if (!isset($_GET['page']) || isset($_GET['A0034'])) {
                          echo 'visually-hidden';
                        } ?>">
    <div class="card col-sm-4 col-md-3 newsCard">
      <div class="card-content">
        <div class="imgFrame">
          <div class="imgTitle">
            <div class="cardFrame d-flex align-items-center justify-content-center" style="border-color: grey;">
              <tx class="text-secondary text-center">Previous seen headlines</tx>
            </div>
          </div>
        </div>
        <a href="<?php echo $prevCont ?>" class="stretched-link"> </a>
      </div>
    </div>
  </div>

  <?php
  if (1 == 1) {
    if (isset($_GET['subcat'])) {
      $block_news_1 = array_slice($block_news_orig, 0, 39);
    } elseif (isset($_GET['A0034'])) {
      $block_news_1 = array_slice($block_news_orig, 0, 47);
    } else {
      $block_news_1 = array_slice($block_news_orig, 40, 39);
    }


    $block_news = $block_news_orig;
    $allcount = sizeof($block_news) - 1;
    $block_news_1 = filter_by_key($block_news_1, null, null, 'deep_link' );
    foreach ($block_news_1 as $row) {
      echo allContentGridCard($row);
    }
  }
  //for ($x = 0; $x <= 48; $x++) {}
  $_SESSION['all_content_grid'] = $block_news;
  ?>
</div>

<div class="d-grid gap-2 justify-content-end pe-5 me-1 <?php echo $btnHd ?>">
  <button type="button" class="load-more btn btn-outline-dark btn-sm w-100 me-4">
    Load More
  </button>
</div>

<input type="hidden" id="row" value="0">
<input type="hidden" id="all" value="<?php echo $allcount; ?>">


<script>
  $(document).ready(function() {

    // Load more data
    $('.load-more').click(function() {
      var row = Number($('#row').val());
      var allcount = Number($('#all').val());

      row = row + 8;

      if (row <= allcount) {
        $("#row").val(row);

        $.ajax({
          url: 'all_content/content_grid_data.php',
          type: 'post',
          data: {
            row: row
          },
          beforeSend: function() {
            //$(".btnspin").addClass("spinner-border spinner-border-sm");
            $(".load-more").text("Loading...");
            $(".load-more").prepend('<span class="spinner-border spinner-border-sm" role="status"></span> ');

          },
          success: function(response) {

            // Setting little delay while displaying new content
            setTimeout(function() {
              // appending posts after last post with class="post"
              $(".post:last").after(response).show().fadeIn("slow");

              var rowno = row + 8;

              // checking row value is greater than allcount or not
              if (rowno > allcount) {

                // Change the text and background
                $('.load-more').text("No more data!");

                $('.load-more').addClass("disabled btn-danger");
              } else {
                $(".load-more").text("Load more");
              }
            }, 2000);


          }
        });
      } else {
        $('.load-more').text("Loading...");

        // Setting little delay while removing contents
        setTimeout(function() {

          // When row is greater than allcount then remove all class='post' element after 3 element
          $('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");

          // Reset the value of row
          $("#row").val(0);

          // Change the text and background
          $('.load-more').text("Load more");
          $('.load-more').css("background", "#15a9ce");

        }, 2000);


      }

    });

  });
</script>