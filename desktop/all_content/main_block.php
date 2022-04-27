<div class="">
<div class="d-flex justify-content-between">
  <div class="">
<h2 style="margin-left:-8px" class="newsHead position-relative"><?php echo $titleHead; ?></h2>
  </div>
  <div class="<?php if(isset($_GET['A0034'])){echo 'visually-hidden';} ?>">
      <a href="all_content.php?page=<?php echo $page ?>&A0034=LoPHH8986&block_id=<?php echo $block_id ?>&cat_id=<?php echo $_GET['cat_id'] ?>&cat_type=<?php echo $_GET['cat_type'] ?>" class="btn btn-outline-dark btn-sm">All headlines</a>
 </div>
  <div class="">
  <ul class="nav justify-content-end" id="myTab">

  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid" type="a" role="tab" aria-controls="grid" aria-selected="true"><i class="fa fa-th-large text-dark" aria-hidden="true"></i></a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="a" role="tab" aria-controls="list" aria-selected="false"><i class="fa fa-list text-dark" aria-hidden="true"></i></a>
  </li>

</ul>

  </div>
</div>

<div style="width:97.6%" class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active mb-3 w-100" id="grid" role="tabpanel" aria-labelledby="grid-tab">
      <?php
include 'grid.php'
      ?>
  </div>
  <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
  <?php
//include 'list.php'
      ?>
  </div>
</div>
 </div>