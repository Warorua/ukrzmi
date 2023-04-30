<?php
//////////////////precounter script
//country
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM country");
$stmt->execute();
$country_count = $stmt->fetch();
//logo
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM logo");
$stmt->execute();
$logo_count = $stmt->fetch();
//images
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM news");
$stmt->execute();
$images_count = $stmt->fetch();
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
$nav = $_SERVER['PHP_SELF'];
$nav_link = basename($nav);
/////////////////////////////
if($nav_link == 'home.php'){
$dashboard_1 = 'menu-open';
$dashboard_2 = 'active';
$dashboard_3 = 'active';
}
//////////////////////////////
if($nav_link == 'manual_view.php' || $nav_link == 'auto_view.php' || $nav_link == 'pinned_articles_view.php' || $nav_link == 'pending_view.php'){
  $news_1 = 'menu-open';
  $news_2 = 'active';
  //nav specific
  if($nav_link == 'manual_view.php'){
$manual_view = 'active';
  }
  if($nav_link == 'pinned_articles_view.php'){
    $pinned_articles = 'active';
  }
  if($nav_link == 'auto_view.php'){
  $auto_view = 'active';
  }
  if($nav_link == 'pending_view.php'){
    $pending_view = 'active';
    }
  
  }
  ///////////////////////////////
if($nav_link == 'tags_view.php'){
  $tags_view = 'active';
   }
     ///////////////////////////////
if($nav_link == 'category_view.php'){
  $category_view = 'active';
   }
     ///////////////////////////////
     if($nav_link == 'navigation_view.php'){
      $navigation_view = 'active';
       }
         ///////////////////////////////
if($nav_link == 'sources_view.php' || $nav_link == 'urls_view.php'){
  $sources_view = 'active';
   }
   
///////////////////////////////
if($nav_link == 'add_news.php'){
 $add_news = 'active';
  }
  
//////////////////////////////
if($nav_link == 'block_view.php' || $nav_link == 'block_add_thematic.php' || $nav_link == 'block_edit.php'|| $nav_link == 'block_add.php'){
  $block_1 = 'menu-open';
  $block_2 = 'active';
  //nav specific
  if($nav_link == 'block_add.php'){
$block_add = 'active';
  }
  if($nav_link == 'block_add_thematic.php'){
    $block_add_thematic = 'active';
  }
  if($nav_link == 'block_view.php'){
  $block_view = 'active';
  }
  

  }
///////////////////////////////
if($nav_link == 'mail_view.php' || $nav_link == 'mail_reg.php' || $nav_link == 'mail_edit.php'){
  $mail_1 = 'menu-open';
  $mail_2 = 'active';
  //nav specific
  if($nav_link == 'mail_view.php'){
$mail_view = 'active';
$mail_edit = 'active';
  }
  if($nav_link == 'mail_reg.php'){
  $mail_configure = 'active';
  }
  

  }
///////////////////////////////
if($nav_link == 'country_view.php'){
  $country_view = 'active';
  }
  if($nav_link == 'logo_view.php'){
    $logo_view = 'active';
    }
    if($nav_link == 'image_view.php'){
      $image_view = 'active';
      }
///////////////////////////////
if($nav_link == 'members_view.php'){
  $rmembers_1 = 'menu-open';
  $rmembers_2 = 'active';
  //nav specific
  if($nav_link == 'members_view.php'){
  $rmembers_view = 'active';
  }
  

  }
///////////////////////////////
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="../bower/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Ukrzmi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../bower/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $admin['firstname'] ?> <?php echo $admin['lastname'] ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?php echo $dashboard_1 ?>">

            <a href="home.php" class="nav-link <?php echo $dashboard_2 ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="home.php" class="nav-link <?php echo $dashboard_3 ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>


            </ul>
          </li>
          <li class="nav-header">NEWS DATA SYSTEM</li> 
          <li class="nav-item">
            <a href="add_news.php" class="nav-link <?php echo $add_news ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Add News
              </p>
            </a>
          </li>   
          <li class="nav-item">
            <a href="tags_view.php" class="nav-link <?php echo $tags_view ?>">
              <i class="nav-icon fa fa-tags"></i>
              <p>
                Tags
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sources_view.php" class="nav-link <?php echo $sources_view ?>">
              <i class="nav-icon fa fa-globe"></i>
              <p>
                Sources
              </p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="category_view.php" class="nav-link <?php echo $category_view ?>">
              <i class="nav-icon fa fa-sitemap"></i>
              <p>
                Categories
              </p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="navigation_view.php" class="nav-link <?php echo $navigation_view ?>">
              <i class="nav-icon fa fa-sitemap"></i>
              <p>
                Navigation
              </p>
            </a>
          </li>    
          <li class="nav-item <?php echo $news_1 ?>">
            <a href="#" class="nav-link <?php echo $news_2 ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                News Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="pending_view.php" class="nav-link <?php echo $pending_view ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending articles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manual_view.php" class="nav-link <?php echo $manual_view ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manual Input</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="auto_view.php" class="nav-link <?php echo $auto_view ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Scraped</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pinned_articles_view.php" class="nav-link <?php echo $pinned_articles ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pinned Articles</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-header">MEMBERSHIP SYSTEM</li>           
          <li class="nav-item <?php echo $rmembers_1 ?>">

<a href="home.php" class="nav-link <?php echo $rmembers_2 ?>">
  <i class="nav-icon fa fa-user-circle"></i>
  <p>
    Registered Members
    <i class="right fas fa-angle-left"></i>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="members_view.php" class="nav-link <?php echo $rmembers_view?>">
      <i class=" fa fa-users nav-icon"></i>
      <p>All Members</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link <?php echo $rmembers_add?>">
      <i class="fa fa-user-plus nav-icon"></i>
      <p>Add new</p>
    </a>
  </li>



</ul>
</li>         
          <li class="nav-item">
            <a href="author_view.php" class="nav-link <?php echo $add_news ?>">
              <i class="nav-icon fa fa-id-badge"></i>
              <p>
                Authors
              </p>
            </a>
          </li>          
 
          <li class="nav-header">UI MANAGEMENT</li> 
          <li class="nav-item <?php echo $block_1 ?>">

<a href="home.php" class="nav-link <?php echo $block_2 ?>">
  <i class="nav-icon fa fa-server"></i>
  <p>
    Block System
    <i class="right fas fa-angle-left"></i>
  </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="block_add.php" class="nav-link <?php echo $block_add ?>">
      <i class="far fa-circle nav-icon"></i>
      <p>Add new</p>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo $block_add_thematic ?>" data-toggle="modal" data-target="#thematic">
      <i class="far fa-circle nav-icon"></i>
      <p>Add new thematic</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="block_view.php" class="nav-link <?php echo $block_view ?>">
      <i class="far fa-circle nav-icon"></i>
      <p>Block View</p>
    </a>
  </li>



</ul>
</li>
          <li class="nav-header">MAIL CONFIGURATION</li> 
          <li class="nav-item <?php echo $mail_1 ?>">
            <a href="#" class="nav-link <?php echo $mail_2 ?>">
              <i class="nav-icon fa fa-envelope"></i>
              <p>
                System SMTP
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="mail_view.php" class="nav-link <?php echo $mail_view ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mail Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="mail_reg.php" class="nav-link <?php echo $mail_configure ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Configure</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">LIBRARY</li> 
          <li class="nav-item">
            <a href="country_view.php" class="nav-link <?php echo $country_view ?>">
              <i class="nav-icon fa fa-flag"></i>
              <p>
               Flags
                <span class="badge badge-info right"><?php echo $country_count['numrows'] ?></span>
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="logo_view.php" class="nav-link <?php echo $logo_view ?>">
              <i class="nav-icon fa fa-tree"></i>
              <p>
               Logos
                <span class="badge badge-info right"><?php echo $logo_count['numrows'] ?></span>
              </p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="image_view.php" class="nav-link <?php echo $image_view ?>">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
               Article images
                <span class="badge badge-info right"><?php echo $images_count['numrows'] ?></span>
              </p>
            </a>
          </li>                 
         

            </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<div class="modal fade" id="thematic">
<div class="modal-dialog modal-lg">
<div class="modal-content">
  <form method="POST" action="block_add_thematic.php">  
  <div class="modal-header">Add new thematic block</div>
  <div class="modal-body"> 
    <div class="col-md-12">
<div class="form-group">
                    <label for="exampleInputEmail1">Page to place the block</label>
                    <div class="form-group">
            
                  <select class="form-control select2bs4" data-placeholder="Enter keywords" name="page" style="width: 100%;"  required>
                    <option value="home">Home page</option>
                    <option value="category">Category page</option>
                    <option value="video">Video page</option>
                        
                  </select>
                </div> 
                  </div>
</div>
<div class="col-md-12">
<div class="form-group">
                    <label for="exampleInputEmail1">Category Content</label>
                    <div class="form-group">
            
                  <select class="form-control select2bs4" data-placeholder="Enter keywords" name="type" style="width: 100%;"  required>
 <?php
$stmt = $conn->prepare("SELECT DISTINCT category FROM news");
$stmt->execute();
$cat = $stmt->fetchAll();
foreach($cat as $row){
        echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';
}
 ?>
                  </select>
                </div> 
                  </div>
</div>
   
  </div>
<div class="modal-footer">
<div class="d-flex justify-content-between">
<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-success">Process</button>
</div>
</div>
  </form> 
</div>
</div>
</div>
 