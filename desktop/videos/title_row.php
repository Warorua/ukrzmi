
<div class="col-md-12">
<h4 class="text-dark">
    <span class="text-secondary"><?php echo $rowParent ?>:</span>
<?php echo $my_title ?>
<span style="float: right;" class="justify-content-end"> 
<a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v text-dark" aria-hidden="true"></i>
            </a>
        <ul class="dropdown-menu">
         <li><h6 class="dropdown-header">Share</h6></li>
          <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/article_content.php?code=<?php echo $data['code'] ?>" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
          <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/article_content.php?code=<?php echo $data['code'] ?>" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
          <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/article_content.php?code=<?php echo $data['code'] ?>" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
          <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/article_content.php?code=<?php echo $data['code'] ?>&media=https://www.ukrzmi.com/images/<?php echo $data['photo'] ?>&description=<?php echo $my_title ?>" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="full_coverage.php?id='.$row['id'].'" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
          <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
        </ul>
</span>
</h4>
<div class="row catTime">

 <div class="col-md-5">
<div style="float: left;"><?php echo $data['time'] ?></div>
<div style="float: left;" class="vr"></div>
<div class="text-secondary" style="float: left;">Uploaded <?php echo timeago($data['time']) ?></div>
</div>


<div class="col-md-7"></div>   
</div>

    </div>

