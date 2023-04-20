<?php
if($rowParent != "уніанської"){
  $vidBox = '
  <iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen="true" frameborder="0" scrolling="no" src="'.$data['video_url'].'" style="border:none;overflow:hidden" height="100%" width="100%"></iframe>';
}
elseif($rowParent == "уніанської"){
    $vid_id = str_replace('https://www.unian.ua/player/', "", $data['video_url']);
    $vidBox = '
<div id="ovva-player"></div>
<script type="text/javascript" src="https://api.1plus1.video/u/pm.js?pid=ovva-player&id='.$vid_id.'"></script>
    ';
}
?>
<div class="catVidRow">
<div class="col-md-12">
<?php echo $vidBox ?>
</div>
</div>
