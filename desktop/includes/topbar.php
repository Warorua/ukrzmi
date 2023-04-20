
<div class="col-md-12 topBlockA container-fluid">
<div class="row topRow">
    
    <div class="col-md-7">
      <div class="row">
          
      <div style="margin-left:-20px" class="col-md-1"><a href="home.php" style="text-decoration: none" class="text-white"><div class="topLogo">U</div></a></div>
          <div class="col-md-1">
<a href="home.php" style="text-decoration: none" class="text-white"><p class="text-light topLogoText">Ukrzmi</p></a>
          </div>
          
           <div class="col-md-2">

           </div>
           <div class="col-md-8">
<nav style="width:100%" class="topSearch navbar navbar-light">
  <form class="container-fluid" method="POST" action="search.php">
    <div class="input-group input-group-sm mt-1">
      <?php
      if(isset($_POST['term'])){
        $val = '"'.$_POST['term'].'';
      }
      else{
        $val = '';
      }
      ?>
      <input  type="text" id="term" name="term"  class="form-control" placeholder="Search" aria-label="Search">
    <button type="submit" class="input-group-text" id="button-addon2"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
  </form>
</nav>
           </div>
      </div>

    </div>
    
    <div class="col-md-1 h-100">
        <div class="topBlockA_1">
            <h5 class="topBlockA_2_text">Блог</h5>
        </div>
    </div>

    <div class="col-md-4">
    <ul class="nav topNav justify-content-end">
  <li class="nav-item">
    <a class="nav-link btn btn-dark btn-sm text-light" style="width:100%" href="../membership/register.php">Увійти</a>
  </li>

  <li class="nav-item">
    <a class="nav-link text-light" href="#"><i class="fa-solid fa-user"></i></a>
  </li>
  
</ul>
    </div>

</div>
</div>



<div class="col-md-12 tobBlockB">
    
</div>