<div class="catImgRow">
<div class="col-md-8">
<img class="articleImage" id="HideImg" src="../images/<?php echo $data['photo'] ?>" class="img-fluid" onerror="hideImg()" alt="...">
</div>
<script>
      function hideImg() {
        document.getElementById("HideImg").src = "<?php echo $data['photo_url'] ?>";
       }
        </script>
 <div class="col-md-4">
<div class="card catCard">
    <div class="card-content">
        <div class="card-body">
<div class="row">
    <div class="col-md-4">
    <img class="catCardImage" src="https://www.pravda.com.ua/android-chrome-192x192.png"/>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5">
        <div class="half-circle">72</div>
        <div class="text-secondary half-circle-text">Source level trust</div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-12">
        <div class="authorName">By <?php echo $data['author'] ?></div>
    </div>
    <div class="col-md-12">
        <div class="text-secondary py-2">National news agency</div>
    </div>
    <div style="margin-top:40px" class="row">
        <div class="text-dark authorScore col-md-10">Author's score: 72/40</div>

        <div class="text-dark authorScore_2 col-md-2">
        <div class="authorScore_icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="The score of author is 72">i</div>
        </div>

    </div>
    <div style="margin-top:20px" class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"><a style="width:100%" class="btn btn-primary" href="#">Follow author</a></div>
        <div class="col-md-1"></div>
    </div>
</div>

        </div>
    </div>
</div>
</div> 

</div>