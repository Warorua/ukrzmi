<div style="background-color: <?php echo $thematic_block[$thematic_id]['bg_color'] ?>;" class="w-100 pb-3">
  <div class="mt-1 mb-3 pt-2 pb-5">
    <div class="col-md-12">
      <img src="../admin/components/logos/<?php echo $thematic_block[$thematic_id]['logo'] ?>" width="50px" class="rounded-circle border border-2 border-secondary" alt="...">
      <b class="text-primary fs-4"><?php echo $thematic_block[$thematic_id]['name'] ?></b>
    </div>
    <div class="col-md-12">

      <style>
        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> {
          position: relative;
        }

        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content {
          white-space: nowrap;
          overflow: hidden;
          margin: 0 5%;
          margin-top: 30px;

        }

        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item {
          display: inline-block;
          width: 25%;
          position: relative;
          vertical-align: top;
          overflow: hidden;
          height: 100%;
          white-space: normal;
          padding: 0 10px;
        }

        @media (max-width: 991px) {
          #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item {
            width: 50%;
          }
        }

        @media (max-width: 767px) {
          #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item {
            width: 100%;
          }
        }


        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item img {
          height: 120px;
          width: 100%;
        }

        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item p {
          font-size: 16px;
          margin: 2px 10px 0 5px;
          text-indent: 15px;
        }

        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item a {
          float: right;
          margin: 0 20px 0 0;
          font-size: 16px;
          color: rgba(0, 0, 0, 0.9);
          font-weight: bold;
          letter-spacing: 1px;
          transition: linear 0.1s;
        }

        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item a:hover {
          text-shadow: 0 0 1px grey;
        }

        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-controls button {
          position: absolute;
          border: none;
          background-color: transparent;
          outline: 0;
          font-size: 30px;
          top: 60px;
          color: rgba(0, 0, 0, 0.4);
          transition: 0.15s linear;
        }

        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-controls button:hover {
          color: rgba(0, 0, 0, 0.8);
        }


        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-controls .MS-left {
          left: 0px;
        }

        #mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-controls .MS-right {
          right: 0px;
        }

        #basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> {
          position: relative;
        }

        #basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content {
          white-space: nowrap;
          overflow: hidden;
          margin: 0 2%;
          height: 50px;
        }

        #basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item {
          display: inline-block;
          width: 20%;
          position: relative;
          vertical-align: top;
          overflow: hidden;
          height: 100%;
          white-space: normal;
          line-height: 50px;
          vertical-align: middle;
        }


        #basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-content .item a {
          line-height: 50px;
          vertical-align: middle;
        }

        #basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-controls button {
          position: absolute;
        }

        #basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-controls .MS-left {
          top: 35px;
          left: 10px;
        }

        #basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?>.MS-controls .MS-right {
          top: 35px;
          right: 10px;
        }

        .titleBadge {
          width: 20px !important;
        }

        .fcIconVid_2 {
          margin: 0;
          text-align: left;
          letter-spacing: 2px;
          color: white;
          position: absolute;
          font-size: 20px;
          height: 24px;
          top: 0;
          font-weight: normal;
          padding: 70px 10px 2px 6px;
          font-family: Roboto;
        }
      </style>

      <?php
      $block_name = $thematic_block[$thematic_id]['id'];
      ?>
      <style>
        .slickk-next-<?php echo $block_name; ?> {
          width: 100%;
        }

        .slickk-prev-<?php echo $block_name; ?> {
          width: 100%;
        }
      </style>
      <?php //echo $block_name; 
      ?>

      <div id="mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>" class=" ">






        <div class="MS-content">

          <?php
          //////////////////////////////////////////////////////////////////////////////////////////////////
          $query = '';
          $qi = '';
          $q2 = [''];
          if ($thematic_block[$thematic_id]['type'] != '') {
            $query .= "AND category = '" . $thematic_block[$thematic_id]['type'] . "'";
            $qi = 'category';
            $q2 = [$thematic_block[$thematic_id]['type']];
          }

          if ($thematic_block[$thematic_id]['sub_cat'] != '') {
            $query .= "AND sub_1 = '" . $thematic_block[$thematic_id]['sub_cat'] . "'";
            $qi = 'sub_1';
            $q2 = [$thematic_block[$thematic_id]['sub_cat']];
          }

          if ($thematic_block[$thematic_id]['content'] != '') {
            $query .= "AND type = '" . $thematic_block[$thematic_id]['content'] . "'";
            $qi = 'type';
            $q2 = [$thematic_block[$thematic_id]['content']];
          }

          if ($thematic_block[$thematic_id]['city'] != '') {
            $city = $thematic_block[$thematic_id]['city'];
            if ($city == 'kyiv') {
              $query .= "AND source = 'Unian.ua/kyiv' OR source = 'ua.korrespondent.net/city/kiev/'";
              $qi = 'source';
              $q2 = ['Unian.ua/kyiv', 'ua.korrespondent.net/city/kiev/'];
            } elseif ($city == 'lviv') {
              $query .= "AND source = 'Unian.ua/lviv'";
              $qi = 'source';
              $q2 = ['Unian.ua/lviv'];
            } elseif ($city == 'odessa') {
              $query .= "AND source = 'Unian.ua/odessa'";
              $qi = 'source';
              $q2 = ['Unian.ua/odessa'];
            } elseif ($city == 'kharkiv') {
              $query .= "AND source = 'Unian.ua/kharkiv'";
              $qi = 'source';
              $q2 = ['Unian.ua/kharkiv'];
            } elseif ($city == 'dnepropetrovsk') {
              $query .= "AND source = 'Unian.ua/kharkiv'";
              $qi = 'source';
              $q2 = ['Unian.ua/kharkiv'];
            } else {
              $query .= "";
              $qi = 'source';
              $q2 = [''];
            }
          }

          /////////////////////////////////////////////////////////////////////////////////////////////////
          $stmt = $conn->prepare("SELECT * FROM news 
  WHERE NOT category=:cat_not
  AND pin=:pin
");
          $stmt->execute(['cat_not' => 'international', 'pin' => 0]);
          $block_news_orig = $stmt->fetchAll();

          $block_news_orig = filter_by_key(
            $block_news_orig,
            $q2,
            $q1,
            'deep_link'
          );


          $block_name = $thematic_block[$thematic_id]['id'];

          $block_news = $block_news_orig;


          $block_news_1 = array_slice($block_news, 0, $thematic_block[$thematic_id]['articles']);

          foreach ($block_news_1 as $row) {
            $rowtitle = $row['title'];

            $maxPos = 92;
            if ($row['sub_1'] != '') {
              $catHolder = $row['sub_1'];
            } else {
              $catHolder = 'Генеральний';
            }

            if ($row['parent'] == "ua.korrespondent.net") {
              $rowParent = "Кореспондент";
            } elseif ($row['parent'] == "pravda.com.ua") {
              $rowParent = "правда";
            } elseif ($row['parent'] == "eurointegration.com.ua") {
              $rowParent = "євроінтеграція";
            } elseif ($row['parent'] == "unian.ua") {
              $rowParent = "уніанської";
            } elseif ($row['parent'] == "life.pravda.com.ua") {
              $rowParent = "правда";
            } elseif ($row['parent'] == "theguardian.com") {
              $rowParent = "The guardian";
            } elseif ($row['parent'] == "") {
              $rowParent = "правда";
            }



            if (strlen($row['title']) < $maxPos) {
              $rowtitle = $row['title'];
              $filtTit = str_replace('"', '', $row['title']);
            } else {
              $lastPos = ($maxPos - 3) - strlen($row['title']);
              $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . '...';
            }
            if ($row['frame_color'] == "") {
              $frameColor = "rgb(0, 0, 0, 0.0)";
            } else {
              $frameColor = $row['frame_color'];
            }
            if ($row['title_badge'] == "") {
              $titleBadge = "";
            } else {
              $titleBadge = '<img src="../admin/' . $row['title_badge'] . '" class="titleBadge" />';
            }
            if ($row['type'] == 'video') {
              $fc_icon = '<div class="fcIconVid_2"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
            } else {
              $fc_icon = '';
            }
            ////////////////////////////////////////////////
            if ($row['type'] == 'video') {
              $fc_link = 'video_content';
            } elseif ($row['type'] == 'podcast') {
              $fc_link = 'podcast';
            } elseif ($row['type'] == '') {
              $fc_link = 'article_content';
            } else {
              $fc_link = 'article_content';
            }

            echo '
      <div class="item w-50">    
      <div style="background-color: ' . $thematic_block[$thematic_id]['bg_color'] . ';" class="card border border-dark rounded h-100">
        <div class="card-content">
    
    <div class="">
          <div class="imgTitle_fc">
           
            <img class="cardPhoto_3" src="https://www.ukrzmi.com/images/' . $row['photo'] . '" height="122px" alt="' . $row['title'] . '" />
            ' . $fc_icon . '
        </div>
     </div>   
     
    
        <div class="">
              <a href="' . $fc_link . '.php?code=' . $row['code'] . '" class="stretched-link"></a> 
              <h6 style="font-size:12px" class="w-100">' . $titleBadge . '' . $rowtitle . '</h6>
        </div>
       
        
      </div>
      </div>    </div>
  ';
          }

          //for ($x = 0; $x <= 48; $x++) {}
          ?>

        </div>
        <div class="MS-controls">
          <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
          <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
        </div>

      </div>
      <?php
      if ($thematic_block[$thematic_id]['speed'] != '') {
        $intervalo = $thematic_block[$thematic_id]['speed'];
      } else {
        $intervalo = 3000;
      }
      ?>
      <script src="../bower/multislider.js"></script>
      <script>
        $('#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?>').multislider({
          continuous: true,
          duration: 2000
        });
        $('#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>').multislider({
          duration: 750,

          interval: <?php echo $intervalo ?>
        });
      </script>


    </div>
  </div>
</div>