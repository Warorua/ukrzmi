 <!-- List Data Block -->
 <ul class="list-group">
                <!-- Display List Item From Database-->
                <?php 
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $tag_content = $stmt->fetchAll();

                $list_first_item = array_slice($tag_content,0,3);
                $tag_content_list = $tag_content;
                $allcount = sizeof($tag_content)-1;

                foreach($list_first_item as $row){
                    
                    $rowtitle = $row['title'];  

                    $maxPos = 92;
                    if($row['parent'] == "ua.korrespondent.net"){
                      $rowParent = "Кореспондент";
                    }
                    elseif($row['parent'] == "pravda.com.ua"){
                      $rowParent = "правда";
                    }
                    elseif($row['parent'] == "eurointegration.com.ua"){
                      $rowParent = "євроінтеграція";
                    }
                    elseif($row['parent'] == "unian.ua"){
                      $rowParent = "уніанської";
                    }
                    elseif($row['parent'] == "life.pravda.com.ua"){
                      $rowParent = "правда";
                    }
                    elseif($row['parent'] == "theguardian.com"){
                      $rowParent = "The guardian";
                    }
                    elseif($row['parent'] == ""){
                      $rowParent = "правда";
                    }
                    
                    
                    
                    if (strlen($row['title']) > $maxPos)
                    {
                        $lastPos = ($maxPos - 3) - strlen($row['title']);
                          $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . '...'; 
                    } 
                    if($row['frame_color'] == ""){
                      $frameColor = "rgb(0, 0, 0, 0.0)";
                    }
                    else{
                      $frameColor = $row['frame_color'];
                    }
                    if($row['title_badge'] == ""){
                      $titleBadge = "";
                    }
                    else{
                      $titleBadge = '<img src="../admin/'.$row['title_badge'].'" class="titleBadge" />';
                    }
                    
      echo '
      <li style="border:none" class="list-group-item my-2 post">
      <div class="row">
      <div class="col-md-3">
       <div class="imgFrame">
        <div class="imgTitle">
         <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
        <img class="" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="120px" width="80%" alt="'.$row['title'].'" />
        
        </div>
         </div> 
      </div>
      <div class="col-md-9">
         <h5 class="">'.$row['title'].'</h5>
        
       
         <div class="w-100 d-flex justify-content-start">
         <small style="margin-top:25px"><span class="text-muted">'.$row['category'].' | '.$row['author'].' | '.$row['time'].'</span></small>
      
         </div>
        
            
      </div>
      <div style="width:98%"><hr/></div>
      <a href="article_content.php?code='.$row['code'].'" class="stretched-link"></a>
      </div>

  </li>
      ';
                    
                }
  $_SESSION['tag_items'] = $tag_content;          
      ?>
                <!-- End if Display List Item From Database-->
                <!--End of No Data list item block-->
                </ul>
            <!-- End List Data Block -->

  
<div class="d-grid gap-2">
 <button type="button" class="load-more btn btn-primary">
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
   
    row = row + 4;

    if(row <= allcount){
        $("#row").val(row);

        $.ajax({
            url: 'tag/list_data.php',
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

                    var rowno = row + 4;

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