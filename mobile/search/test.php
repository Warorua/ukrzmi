<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Autocomplete Search Box in PHP MySQL - Tutsmake.com</title>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="saas_style.scss" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css'>
    <link href="../bower/fontawesome/css/all.css" rel="stylesheet">
    <link href="../bower/fontawesome/css/fontawesome.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/6ba6dd3935.js"></script>
    <link href="../bower/fontawesome/css/brands.css" rel="stylesheet">
    <link href="../bower/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <!---international block--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <title>UkrZmi</title>
    <!-------------------JQUERY SCRIPTS------------------------------------------->
<!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 

    <script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.js'></script>
</head>
<body> 
<div class="container">
  <div class="row">
     <h2>Search Here</h2>
     <input type="text" name="term" id="term" placeholder="search here...." class="form-control">  
  </div>
</div>
<script type="text/javascript">
  $(function() {
     $( "#term" ).autocomplete({
       source: 'title_autocomplete.php',
     });
  });
</script>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
    document.addEventListener('click',function(e){
  // Hamburger menu
  if(e.target.classList.contains('hamburger-toggle')){
    e.target.children[0].classList.toggle('active');
  }
}) 
</script>
</body>
</html>