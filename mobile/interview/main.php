<div class="">
<div class="d-flex justify-content-between">
  <div class="col-md-9">
<h2 class="newsHead">Featured Interviews</h2>
  </div>
  <div class="col-md-3">
  <ul class="nav justify-content-end" id="myTab">

  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid" type="a" role="tab" aria-controls="grid" aria-selected="true"><i class="fa fa-th-large" aria-hidden="true"></i></a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="a" role="tab" aria-controls="list" aria-selected="false"><i class="fa fa-list" aria-hidden="true"></i></a>
  </li>

</ul>

  </div>
  <div class="col-md-1"></div>
</div>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
      <?php
include 'interview/grid.php'
      ?>
  </div>
  <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
  <?php
include 'interview/list.php'
      ?>
  </div>
</div>
 </div>