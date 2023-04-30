<div class="container-fluid">
  <div style="height: 100px" class="row topRow">
    <div class="col-md-9">
      <div class="navbarBox">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content">
              <div class="hamburger-toggle">
                <div class="hamburger">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>
            </button>
            <div class="collapse navbar-collapse" id="navbar-content">
              <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link navLink  dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">All cities</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="city.php?id=kyiv">Kyiv</a></li>
                    <li><a class="dropdown-item" href="city.php?id=lviv">Lviv</a></li>
                    <li><a class="dropdown-item" href="city.php?id=odessa">Odessa</a></li>
                    <li><a class="dropdown-item" href="city.php?id=kharkiv">Kharkiv</a></li>
                    <li><a class="dropdown-item" href="city.php?id=dnepropetrovsk">Dnepropetrovsk</a></li>


                  </ul>
                </li>
                <li class="nav-item vr"></li>
                <?php

                if (isset($city)) {
                  $navStatus = '';
                  $navHide = 'visually-hidden';
                } else {
                  $navStatus = 'visually-hidden';
                  $navHide = '';
                }

                if (isset($wanted_blocks)) {
                  $drp_cnt = $wanted_blocks;
                } else {
                  $drp_cnt = 20;
                }

                for ($bb = 1; $bb <= $drp_cnt; $bb++) {
                  if (isset($block[$bb]['name'])) {
                    echo '
                     <li class="nav-item dropdown dropdown-mega position-static ' . $navHide . '">
                      <a class="nav-link navLink " href="category.php?cat_id=' . $block[$bb]['type'] . '" data-bs-toggle="" data-bs-auto-close="outside">' . $block[$bb]['name'] . '</a>
                         ' . dropdown(newsFetch(), $block, $bb) . '
                     </li>
                     ';
                  }
                }


                ?>
                <li class="nav-item dropdown dropdown-mega position-static <?php echo $navStatus ?>">
                  <a class="nav-link navLink " href="city.php?id=<?php echo $city ?>&cat=headlines">Headlines</a>
                </li>
                <li class="nav-item dropdown dropdown-mega position-static <?php echo $navStatus ?>">
                  <a class="nav-link navLink " href="city.php?id=<?php echo $city ?>&cat=l_a">Local authorities</a>
                </li>
                <li class="nav-item dropdown dropdown-mega position-static <?php echo $navStatus ?>">
                  <a class="nav-link navLink " href="city.php?id=<?php echo $city ?>&cat=business">Business</a>
                </li>
              </ul>

            </div>

        </nav>

        <!----------------------------------------------------------------------------------->

      </div>


      <?php
      $nav = $_SERVER['PHP_SELF'];
      $nav_link = basename($nav);

      if (isset($city)) {
        $city = $city;
      } else {
        $city = '';
      }
      if (isset($data)) {
        $topCat = pageNav($nav_link, $data, $city, $_GET)[0];
        $pageNm = pageNav($nav_link, $data, $city, $_GET)[1];
      } else {
        $topCat = pageNav($nav_link, null, $city, $_GET)[0];
        $pageNm = pageNav($nav_link, null, $city, $_GET)[1];
      }





      if ($nav_link == 'full_coverage.php') {
        $topCat = 'FULL COVERAGE';
        $topHide = 'style="display:none"';
      } else {
        $topHide = '';
      }
      /////////////video
      if ($nav_link == 'video.php' || $nav_link == 'video_content.php') {
        $topClassVideo = 'text-primary border-bottom-4 border-primary';
        $topClass = 'text-dark';
      } else {
        $topClass = 'text-dark';
        $topClassVideo = 'text-dark';
      }
      /////////////interview
      if ($nav_link == 'interview.php') {
        $topClassInterview = 'text-primary border-bottom-4 border-primary';
        $topClass = 'text-dark';
      } else {
        $topClass = 'text-dark';
        $topClassInterview = 'text-dark';
      }
      /////////////voices
      if ($nav_link == 'voices.php') {
        $topClassVoice = 'text-primary border-bottom-4 border-primary';
        $topClass = 'text-dark';
      } else {
        $topClass = 'text-dark';
        $topClassVoice = 'text-dark';
      }
      /////////////home
      /*
if($nav_link == 'home.php'){
  $topClassHome = 'text-primary border-bottom-4 border-primary';
  $topClass = 'text-dark';
}
*/
      if ($nav_link == 'home.php') {
        $topClassHome = 'text-dark';
        $topClass = 'text-dark';
      } elseif ($nav_link == 'category.php' && isset($_GET['cat_id']) && !isset($_GET['subcat'])) {
        $topClassHome = 'text-primary border-bottom-4 border-primary';
        $topClass = 'text-dark';
      } elseif ($nav_link == 'all_content.php' && !isset($_GET['subcat'])) {
        $topClassHome = 'text-primary border-bottom-4 border-primary';
        $topClass = 'text-dark';
      } else {
        $topClass = 'text-dark';
        $topClassHome = 'text-dark';
      }


      $nav = $_SERVER['PHP_SELF'];
      $nav_link = basename($nav);
      if ($nav_link == 'category.php') {
        $subNavCont = "?cat=" . $_GET['cat_id'];
      } else {
        $subNavCont = "";
      }

      if ($nav_link == 'category.php') {
        $homeNavCont = "category.php?cat_id=" . $_GET['cat_id'];
      } elseif (isset($_GET['cat_id'])) {
        $homeNavCont = "category.php?cat_id=" . $_GET['cat_id'];
      } elseif (isset($_GET['subcat'])) {
        $homeNavCont = "category.php?cat_id=" . $_GET['cat_id'];
      } else {
        $homeNavCont = "home.php";
      }
      /////////////////////////////////////////////////////
      if (isset($_GET['cat_type'])) {
        if ($_GET['cat_type'] == '') {
          $homeNavCont = 'home.php';
        } else {
          $homeNavCont = 'category.php?cat_id=' . $_GET['cat_type'];
        }
      } elseif (isset($_GET['cat_type_two'])) {
        $homeNavCont = 'all_content.php?cat_id=' . $_GET['cat_id'] . '&subcat=' . $_GET['cat_type_two'];
      } elseif (isset($_GET['cat_type_three'])) {
        $homeNavCont = 'city.php?id=' . $_GET['cat_type_three'];
      } elseif (isset($_GET['cat_type_four'])) {
        $homeNavCont = $_GET['cat_type_four'];
      }
      /////////////////////////////////////////////////////
      if (isset($_GET['page'])) {
        $myPg = $_GET['page'];
      } else {
        $myPg = "";
      }
      if ($nav_link == 'interview.php' || $nav_link == 'voices.php' || $nav_link == 'video.php' || $nav_link == 'all_content.php' && $myPg != 'home' || $myPg != '') {
        if (!isset($_GET['cat_id'])) {
          $subNavCont = "";
        } else {
          $subNavCont = "?cat_id=" . $_GET['cat_id'];
          $topCat = ucfirst($_GET['cat_id']);
          //  $subTit = ucfirst($_GET['cat']);
        }
        if (isset($_GET['city'])) {
          $subNavCont = "?city=" . $_GET['city'];
          $topCat = ucfirst($_GET['city']);
          //$subTit = ucfirst($_GET['city']);
        }
        if (isset($_GET['subcat'])) {
          $subNavCont = "?cat_id=" . $_GET['cat_id'];
          $topCat = ucfirst($_GET['cat_id']);
          $subTit = ucfirst($_GET['subcat']);
        }
      }
      if ($nav_link == 'city.php') {
        $subNavCont = "?city=" . $_GET['id'];
        $topCat = ucfirst($_GET['id']);
        // $subTit = ucfirst($_GET['id']);
      }
      if (isset($_GET['cat_type'])) {
        if ($_GET['cat_type'] == '') {
          $subNavCont = 'home.php';
        } else {
          $subNavCont = '?cat_id=' . $_GET['cat_type'];
        }
      }




      if (isset($subTit)) {
        $titSytle = "margin-top: 8px;margin-bottom:0px; line-height:0.74";
        $titCont = '<br/>
<tx style="margin-bottom:-30px; font-size:15px" class="text-muted">' . $subTit . '</tx>';
      } else {
        $titSytle = "margin-top: 15px";
        $titCont = '';
      }
      ?>

      <h3 style="<?php echo $titSytle  ?>" class="text-primary pageCat pb-0"><?php echo strtoupper($topCat) ?><?php echo $titCont ?>
      </h3>

      <div <?php echo $topHide ?> class="navbarBottom b-4">
        <ul class="nav">

          <li class="nav-item">
            <a class="nav-link navLink  text-secondary" href="#">Мій канал</a>
          </li>
          <?php
          if (isset($_GET['cat_id'])) {
            $stmt = $conn->prepare("SELECT *, sub_cat.name AS subcat FROM sub_cat LEFT JOIN category ON sub_cat.category=category.id");
            $stmt->execute();
            $sub_cats = $stmt->fetchAll();

            $sub_cats = filter_by_key(
              $sub_cats,
              [
                $_GET['cat_id']
              ],
              'name',
              'id'
            );

            foreach ($sub_cats as $row) {
              if (isset($_GET['subcat'])) {
                if ($_GET['subcat'] == $row['subcat']) {
                  $topClassSubcat = 'text-primary border-bottom-4 border-primary';
                } else {
                  $topClassSubcat = 'text-dark';
                }
              } else {
                $topClassSubcat = 'text-dark';
              }

              echo '
                 <li class="nav-item">
                  <a class="nav-link navLink ' . $topClassSubcat . '" href="all_content.php?subcat=' . $row['subcat'] . '&cat_id=' . $_GET['cat_id'] . '">' . $row['subcat'] . '</a>
                 </li>
                 ';
            }
          }

          //echo "<script>alert('".$subNavCont."')</script>";
          ?>
          <li class="nav-item">
            <a class="nav-link navLink  <?php echo $topClassHome ?>" href="<?php echo $homeNavCont ?>">Заголовки</a>
          </li>
          <?php
          $stmt = $conn->prepare("SELECT * FROM navlinks WHERE status=:status");
          $stmt->execute(['status' => '1']);
          $navigation = $stmt->fetchAll();
          foreach ($navigation as $rows) {
            if ($rows['link'] == 'interview.php') {
              $navigationKey = $topClassInterview;
            } elseif ($rows['link'] == 'voices.php') {
              $navigationKey = $topClassVoice;
            } elseif ($rows['link'] == 'video.php') {
              $navigationKey = $topClassVideo;
            } else {
              $navigationKey = 'text-dark';
            }
            echo '
            <li class="nav-item">
            <a class="nav-link navLink  '.$navigationKey.'" href="'.$rows['link'].$subNavCont.'">'.$rows['name'].'</a>
            </li>
            ';
          }
          ?>

        </ul>

      </div>


    </div>

    <div <?php echo $topHide ?> class="col-md-3 mt-2">


      <ul class="nav nav-fill justify-content-end feedbackRow">
        <li class="nav-item">
          <Font size="2">
            &nbsp <a href="mailto:admin@ukrzmi.com" style="color: #000000">Надсилає нам ваш відгук</a></Font>
        </li>

      </ul>

      <h3 class="text-primary pageDesc text-dark">"Усі важливі щоденні новини з надійних джерел"</h3>

      <div style="font-size: 12px; margin-bottom:-15px;" class="d-flex justify-content-between w-100 pt-2 pe-3">
        <i style="margin-left:-49px" class="fa fa-heart text-danger text-start pt-1"></i>
        <div class="text-start">
          Рекламуйте безкоштовно: вакансії - події - банери &nbsp &nbsp
        </div>
      </div>
    </div>

  </div>

  <hr <?php echo $topHide ?> class="navbarHr">


</div>