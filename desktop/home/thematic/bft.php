<div style="background-color: <?php echo $thematic_block[$thematic_id]['bg_color'] ?>;" class="w-100 cardBlock row">
    <div class="row p-3">
        <div class="col-md-12">
        <img src="../admin/components/logos/<?php echo $thematic_block[$thematic_id]['logo'] ?>" width="50px" class="rounded-circle border border-2 border-secondary" alt="...">
        <b class="text-primary fs-4"><?php echo $thematic_block[$thematic_id]['name'] ?></b>
        </div>
        <div class="col-md-12">
       
<style>

#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> {
  position: relative;
}
#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 5%;
  margin-top: 30px;
  margin-bottom: -10px;
}
#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content .item {
  display: inline-block;
  width: 25%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  padding: 0 10px;
}




#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls button {
  position: absolute;
  border: none;
  background-color: transparent;
  outline: 0;
  font-size: 30px;
  top: 60px;
  color: rgba(0, 0, 0, 0.4);
  transition: 0.15s linear;
}
#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls button:hover {
  color: rgba(0, 0, 0, 0.8);
}


#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls .MS-left {
  left: 0px;
}

#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls .MS-right {
  right: 0px;
}

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> { position: relative; }

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 2%;
  height: 50px;
}

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content .item {
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


#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content .item a {
  line-height: 50px;
  vertical-align: middle;
}

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls button { position: absolute; }

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls .MS-left {
  top: 35px;
  left: 10px;
}

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls .MS-right {
  top: 35px;
  right: 10px;
}
</style>
<?php 
 $block_name = $thematic_block[$thematic_id]['id'];
?>
<style>
  .slickk-next-<?php echo $block_name; ?>{
  width: 100%;
}
.slickk-prev-<?php echo $block_name; ?>{
  width: 100%;
}

</style>
<?php //echo $block_name; ?>

<div id="mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>" class=" ">






<div class="MS-content">

  <?php

  $block_news_orig = $allNews;

                //*
                if ($thematic_block[$thematic_id]['type'] != '') {

                  $block_news_orig = filter_by_key($block_news_orig, [$thematic_block[$thematic_id]['type']], 'category', 'deep_link');
                }
                //*/

                //*
                if ($thematic_block[$thematic_id]['sub_cat'] != '') {

                  $block_news_orig = filter_by_key($block_news_orig, [$thematic_block[$thematic_id]['sub_cat']], 'sub_1', 'deep_link');
                }
                //*/

                //*
                if ($thematic_block[$thematic_id]['content'] != '') {

                  $block_news_orig = filter_by_key($block_news_orig, [$thematic_block[$thematic_id]['content']], 'type', 'deep_link');
                }
                //*/

                //*
                if ($thematic_block[$thematic_id]['city'] != '') {

                  $city = $thematic_block[$thematic_id]['city'];
                  if ($city == 'kyiv') {
                    $block_news_orig = filter_by_key($block_news_orig, ['Unian.ua/kyiv', 'ua.korrespondent.net/city/kiev/'], 'source', 'deep_link');
                  } elseif ($city == 'lviv') {
                    $block_news_orig = filter_by_key($block_news_orig, ['Unian.ua/lviv'], 'source', 'deep_link');
                  } elseif ($city == 'odessa') {
                    $block_news_orig = filter_by_key($block_news_orig, ['Unian.ua/odessa'], 'source', 'deep_link');
                  } elseif ($city == 'kharkiv') {
                    $block_news_orig = filter_by_key($block_news_orig, ['Unian.ua/kharkiv'], 'source', 'deep_link');
                  } elseif ($city == 'dnepropetrovsk') {
                    $block_news_orig = filter_by_key($block_news_orig, ['Unian.ua/dnepropetrovsk'], 'source', 'deep_link');
                  }
                }
            //*/
   
  $block_name = $thematic_block[$thematic_id]['id'];
 
    $block_news = $block_news_orig;


  $block_news_1 = array_slice($block_news,0,$thematic_block[$thematic_id]['articles']);

foreach($block_news_1 as $row){
echo thematicCard($row, $thematic_block, $thematic_id);
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
if($thematic_block[$thematic_id]['speed'] != ''){
    $intervalo = $thematic_block[$thematic_id]['speed'];
}
else{
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