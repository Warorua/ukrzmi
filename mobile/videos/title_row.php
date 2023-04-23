
<div class="col-md-12">
<div class="d-flex justify-content-between p-1">
<h5 class="text-dark">
    <span class="text-secondary"><?php echo $rowParent ?>:</span>
<?php echo $my_title ?>
</h5>
<span class="d-flex justify-content-start"> 
<a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
        </a>
        <ul class="dropdown-menu">
         <li><h6 class="dropdown-header">Share</h6></li>
          <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=http://localhost/news/desktop/article_content.php?code=<?php echo $data['code'] ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
          <li><a class="dropdown-item" href="https://twitter.com/share?url=http://localhost/news/desktop/article_content.php?code=<?php echo $data['code'] ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
          <li><a class="dropdown-item" href="whatsapp://send?text=http://localhost/news/desktop/article_content.php?code=<?php echo $data['code'] ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
          <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=http://localhost/news/desktop/article_content.php?code=<?php echo $data['code'] ?>&media=https://localhost/news/scrap2/images/<?php echo $data['photo'] ?>&description=<?php echo $my_title ?>" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="full_coverage.php?id=<?php echo $data['id'] ?>" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
          <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
        </ul>
</span>
</div>

<div class="d-flex justify-content-between border border-dark w-100">

<div style="font-size:13px;" class="w-33 text-center"><?php echo $data['time'] ?></div>

<div class="w-33 text-center border border-dark border-top-0 border-bottom-0 lh-lg">
<i class="fa fa-share-alt fa-lg" aria-hidden="true"></i>
</div>

<div class="w-25">
<div class="half-circle">72</div>
</div>

</div>


    </div>

