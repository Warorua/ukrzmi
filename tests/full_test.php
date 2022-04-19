<?php
include '../includes/conn.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>UkrZmi</title>
  </head>
  <body>
      
 <div class="container">
     <br/>
      <br/>
      <br/> <h6 class="display-6">Full Coverage Testing</h6>
      <br/>
      <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='alert alert-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "
          <div class='alert alert-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
      <br/>
     <div class="jumbotron">
         <h3>Usage:</h3>
         <p class="text-dark">
             Test the efficiency of the NLS system here. Input 2 sentences and the system will calculate the percentage of the similarity between the 2 sentences. This is the mechanism that will be used in the <code>Full Coverage</code> system to determine the similarity between 2 titles of 2 different articles.
         </p>
     </div>
     <br/>
    <form id="fetchProd" method="POST">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Sentence 1</label>
    <input name="st1" type="text" class="form-control" required>
    <label for="exampleInputPassword1" class="form-label">Sentence 2</label>
    <input name="st2" type="text" class="form-control"  required>
  </div>

  <button type="submit" class="btn btn-primary">Compare</button>
</form>
<br/>
<div id="fetchPr"></div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
      
$(document).on('submit','#fetchProd',function(e){
        e.preventDefault();
                
         var st1= $("input[name='st1']").val();
         var st2= $("input[name='st2']").val();
        $.ajax({
        method:"POST",
        url: "full_coverage.php",
        data:{
         st2:st2,
          st1:st1
           },
        success: function(data){
            alert("Results ready!");
          $("#fetchPr").html(data); 
          
   
    }});
});

  </script>
</html>