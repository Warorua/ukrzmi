<div class="col-sm-12">
<div class="offcanvas offcanvas-start bg-dark text-light" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
    <nav style="width:100%" class="topSearch navbar navbar-light">
    <?php
      if(isset($_POST['term'])){
        $val = '"'.$_POST['term'].'"';
      }
      else{
        $val = '';
      }
      ?>
  <form class="container-fluid" method="POST" action="search.php">
    <div class="input-group input-group-sm">
      <input  type="text" id="term" name="term"  class="form-control" placeholder="Search" aria-label="Search">
      <button type="submit" class="input-group-text" id="button-addon2"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
  </form>
</nav>
    </h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    
  <div class="d-flex justify-content-between">
<div style="width: 30%;" class=""> 

     
        <ul  style="margin-left:-20px;" class="nav flex-column">
        <li class="nav-item dropdown">
    <a class="nav-link  dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">All cities</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="city.php?id=kyiv">Kyiv</a></li>
      <li><a class="dropdown-item" href="city.php?id=lviv">Lviv</a></li>
      <li><a class="dropdown-item" href="city.php?id=odessa">Odessa</a></li>
      <li><a class="dropdown-item" href="city.php?id=kharkiv">Kharkiv</a></li>
      <li><a class="dropdown-item" href="city.php?id=dnepropetrovsk">Dnepropetrovsk</a></li>
    
      
    </ul>
  </li>

          <?php

          if(isset($city)){
            $navStatus = '';
            $navHide = 'visually-hidden';
          }
          else{
            $navStatus = 'visually-hidden';
            $navHide = '';
          }
    ?>     
      <?php
 if(isset($block[0]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="home.php" data-bs-toggle="" data-bs-auto-close="outside">'.$block[0]['name'].'</a>
    
  </li>
  ' ;
  } 
if(isset($block[1]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[1]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[1]['name'].'</a>
    
  </li>
  ' ;
  }
  if(isset($block[2]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[2]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[2]['name'].'</a>
    
  </li>
  ' ;
  }
  if(isset($block[3]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[3]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[3]['name'].'</a>
    
  </li>
  ' ;
  }
  if(isset($block[4]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[4]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[4]['name'].'</a>
    
  </li>
  ' ;
  }
  if(isset($block[5]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[5]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[5]['name'].'</a>
    
  </li>
  ' ;
  }
  if(isset($block[6]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[6]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[6]['name'].'</a>
    
  </li>
  ' ;
  }
  if(isset($block[7]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[7]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[7]['name'].'</a>
    
  </li>
  ' ;
  }
  if(isset($block[8]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[8]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[8]['name'].'</a>
    
  </li>
  ' ;
  }
  if(isset($block[9]['name'])){
  echo '
  <li class="nav-item dropdown  position-static '.$navHide.'">
    <a class="nav-link " href="category.php?cat_id='.$block[9]['type'].'" data-bs-toggle="" data-bs-auto-close="outside">'.$block[9]['name'].'</a>
    
  </li>
  ' ;
  }
  ?>
  <li class="nav-item dropdown  position-static <?php echo $navStatus ?>">
    <a class="nav-link " href="city.php?id=<?php echo $city ?>&cat=headlines">Headlines</a>
  </li>
  <li class="nav-item dropdown  position-static <?php echo $navStatus ?>">
    <a class="nav-link " href="city.php?id=<?php echo $city ?>&cat=l_a">Local authorities</a>
  </li>
  <li class="nav-item dropdown  position-static <?php echo $navStatus ?>">
    <a class="nav-link " href="city.php?id=<?php echo $city ?>&cat=business">Business</a>
  </li>
        </ul>


</div>
<div style="height: 23em;" class="vr"></div>


<div style="width: 70%;" class="">
<div class="fw-bold p-2">Roberta</div>

  <div class="d-flex justify-content-between p-2">
  <a href="#" class="text-light">Public profile</a>
  <div class="badge bg-light text-dark">21.4k</div>
  </div>

  <div class="d-flex justify-content-between p-2">
  <hr class="w-100"/>
  </div>

  <div class="d-flex justify-content-between p-2">
  <i class="fa fa-bell fa-2x position-relative" aria-hidden="true">
  <span class="position-absolute top-25 start-100 translate-middle badge rounded-circle bg-danger p-2"><span class="visually-hidden">unread messages</span></span>
  </i>
  <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
  <i class="fa fa-question-circle fa-2x" aria-hidden="true"></i>
  </div>

  <div class="d-flex justify-content-between p-2">
  <a class="btn btn-warning spBtn_1">My blog</a>
  <a class="btn btn-primary spBtn_1">My stats</a>
  </div>

  <div class="d-flex justify-content-between p-2">
  <a class="btn btn-danger spBtn_1">My ads</a>
  <a class="btn btn-info spBtn_1">My prof</a>
  </div>

  <div class="d-flex justify-content-between p-2">
  <a class="btn btn-success spBtn">Submit content</a>
  <a class="btn btn-light spBtn">My settings</a>
  </div>
</div>

  
  </div>

  <div class="d-flex justify-content-center p-4">
  <a class="btn btn-light w-100"><i class="fa fa-star" aria-hidden="true"></i> Evaluate Ukrzmi</a>
 
  </div>


  </div>
</div>
</div>
