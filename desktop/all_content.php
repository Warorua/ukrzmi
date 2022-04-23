<?php
include 'includes/header.php';

include 'all_content/process.php';

?>

<body class="">
<?php include 'all_content/includes_file.php' ?>
<div class="newsContainer">
    <div class="row homeContent">
        <div class="col-md-9 col-lg-9 col-xl-9 cardColumn">

<?php include 'all_content/prev_seen.php' ?>




<?php //echo $block[1]['name']; ?>
<?php echo $titleHead; ?>
<div  class="cardBlock row">


<div class="">

<div class="row">
<?php include 'all_content/main_block.php' ?> 
</div>

</div>




</div>

<div class="d-grid gap-2 justify-content-end pe-5 me-1 <?php echo $btnHd ?>">
 <button type="button" class="load-more btn btn-outline-dark btn-sm w-100 me-4">
 Load More
</button>
</div>

<input type="hidden" id="row" value="0">
 <input type="hidden" id="all" value="<?php echo $allcount; ?>">


 <script>
        $(document).ready(function(){

// Load more data
$('.load-more').click(function(){
    var row = Number($('#row').val());
    var allcount = Number($('#all').val());
   
    row = row + 8;

    if(row <= allcount){
        $("#row").val(row);

        $.ajax({
            url: 'content/content_list_data.php',
            type: 'post',
            data: {row:row},
            beforeSend:function(){
                 //$(".btnspin").addClass("spinner-border spinner-border-sm");
                $(".load-more").text("Loading...");
                $(".load-more").prepend('<span class="spinner-border spinner-border-sm" role="status"></span> ');
               
            },
            success: function(response){

                // Setting little delay while displaying new content
                setTimeout(function() {
                    // appending posts after last post with class="post"
                    $(".post:last").after(response).show().fadeIn("slow");

                    var rowno = row + 8;

                    // checking row value is greater than allcount or not
                    if(rowno > allcount){

                        // Change the text and background
                        $('.load-more').text("No more data!");
                     
                        $('.load-more').addClass("disabled btn-danger");
                    }else{
                        $(".load-more").text("Load more");
                    }
                }, 2000);


            }
        });
    }else{
        $('.load-more').text("Loading...");

        // Setting little delay while removing contents
        setTimeout(function() {

            // When row is greater than allcount then remove all class='post' element after 3 element
            $('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");

            // Reset the value of row
            $("#row").val(0);

            // Change the text and background
            $('.load-more').text("Load more");
            $('.load-more').css("background","#15a9ce");

        }, 2000);


    }

});

});
    </script>












  <?php
include 'includes/subscribe.php';
?>

        </div>

        <div class="col-md-3 cardColumn_2">
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
</body>

<script src="../bower/dist/js/adminlte.min.js"></script>