<div class="cardBlock">
<div class="row d-flex justify-content-between">
  <div class="col-md-9">
<h2 style="margin-left:-8px" class="newsHead">Last Main Headlines</h2>
  </div>

  <div class="col-md-2 me-4">
  <ul class="nav justify-content-end" id="myTab">

  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid" type="button" role="tab" aria-controls="grid" aria-selected="true"><i class="fa fa-th text-dark" aria-hidden="true"></i></a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="false"><i class="fa fa-list text-dark" aria-hidden="true"></i></a>
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
include 'list.php'
      ?>
  </div>
</div>
 </div>