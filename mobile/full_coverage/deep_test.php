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
             Input a sentence(Mostly a title of an article) and the system will make comparison tests with the data in the database. The system will test titles of the 150 lastly scraped articles from the database and will give the percentage of similarity between your sentence.
         </p>
     </div>
     <br/>
    <form method="POST" action="nlp2.php">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Article content</label>
   
    <textarea  name="st1" class="form-control" id="exampleFormControlTextarea1" rows="5" required></textarea>
   </div>

  <button type="submit" class="btn btn-primary">Test</button>
</form>
<br/>

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
  
  </script>
</html>