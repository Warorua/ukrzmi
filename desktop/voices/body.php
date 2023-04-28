<?php
include('full_coverage/vendor/autoload.php');

use \NlpTools\Tokenizers\WhitespaceTokenizer;

$tok = new WhitespaceTokenizer();

include 'voices/main.php'
?>

<hr style="margin-top:40px" />

<!-- List Data Block -->
<ul class="list-group list-group-flush w-100">
  <?php
  //Get first 3 from array
  $list_first_item = array_slice($block_news, 0, 3);
  $block_news_list = $block_news;
  $allcount = sizeof($block_news) - 1;
  foreach ($list_first_item as $row) {
    echo voicesCard($row, $tok);
  }
  $_SESSION['voice_items'] = $block_news;
  ?>

  <!-- End List Data Block -->

  <div class="d-grid gap-2 justify-content-end pe-5 me-1">
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

        row = row + 4;

        if (row <= allcount) {
          $("#row").val(row);

          $.ajax({
            url: 'voices/list_data.php',
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

                var rowno = row + 4;

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