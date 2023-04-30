<div class="col-md-12">

  <ul class="list-group list-group-flush">
    <?php
    foreach ($block_news_1 as $row) {
      echo interviewListCard($row);
      // echo $row['full_coverage'];
    }
    ?>
  </ul>
</div>