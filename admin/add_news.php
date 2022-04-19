<?php
include 'components/header.php';
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../bower/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <?php
include 'components/topbar.php';
include 'components/navbar.php';
?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manually Input Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manually Input</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<form action="news_records/add_news_process.php" name="articleForm" id="articleForm" class="dropzone"  method="post" enctype="multipart/form-data">
 <!-- article_data -->
 <div  id="logoUpload">
<?php include 'news_records/form_article_data.php' ?>
<!-- /article_data -->

 <!-- author_edit -->
 <?php include 'news_records/form_author_edit.php' ?>
 <!-- /author_edit -->

<!-- /.article content entry card -->
<?php include 'news_records/form_article_entry.php' ?>
<!-- /.article content entry card -->



<!-- Color Frame Picker -->
<?php include 'news_records/form_color_picker.php' ?>
<!-- Color Picker -->

<!-- Tags & SEO -->
<?php include 'news_records/form_tags_seo.php' ?>
  <!-- Tags & SEO -->

<!-- Symbol before title -->
<?php include 'news_records/form_symbol_title.php' ?>
<!-- Symbol before title -->

<!-- Meta Information -->
<?php include 'news_records/form_meta_information.php' ?>
<!-- Meta Information -->

<!-- Pinned Cards -->
<?php include 'news_records/form_pinned_cards.php' ?>
<!-- Pinned Cards -->

<!-- Pinned Cards/Pages -->
<?php include 'news_records/form_pinned_pages.php' ?>
<!-- Pinned Cards/Pages -->

<!-- Pinned Cards -->
<?php include 'news_records/form_post_time.php' ?>
<!-- Pinned Cards -->

<!-- /.photo uplaod row -->
<?php include 'news_records/form_photo_upload.php' ?>
<!-- /.photo uplaod row -->
<div class="card">
        <div class="card-body">
        <button type="button" id="uploadButton" name="article" class="btn btn-primary startt">
              <i class="fas fa-upload"></i>
              <span>Start upload</span>
              </button>
    


           <button type="submit" class="btn btn-warning" disabled>
              <i class="fas fa-upload"></i>
              <span>Start upload</span>
              </button>
          <div id="txtTest"></div>
      </div>
      </div>
 </div>
 </form>
            
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
include 'components/footer.php';
?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
include 'components/scripts.php';
?>


<script>
    var room = 0;

    function add_fields() {
        room++;
        var objTo = document.getElementById('room_fileds')
        var divtest = document.createElement("div");
        
        divtest.innerHTML = ' <div class="row"> <div class="col-md-1 pt-3"> <h5 class="font-weight-bold pt-3">Block ' + room +'</h5> </div> <div class="col-md-1"> <div class="icheck-primary d-inline"> <input type="checkbox" name="pinCardd' + room +'" value="1" id="pinCardd' + room +'"> <label for="pinCardd' + room +'"> </label> </div> </div> <div class="col-md-2"> <div class="form-group"> <label>Pin card to page:</label> <div class="form-group"> <select class="form-control select2bs4" name="cardPage' + room +'"> <option value="category">Category page</option> <option value="tag">Tags page</option> <option value="voice">Voices page</option> <option value="interview">Interviews page</option> <option value="video">Videos page</option> </select> </div> </div> </div>  <div class="col-md-1"> <div class="form-group"> <label>Block:</label> <div class="form-group"> <select class="form-control select2bs4" name="block' + room +'">                        <?php for($y = 1; $y<=10; $y++){ echo '<option value="'.$y.'">Block '.$y.'</option>'; } ?> </select> </div> </div> </div>  <div class="col-md-2"> <label>Pin Position:</label> <div class="form-group"> <select class="form-control select2bs4" name="cardPositionn' + room +'"> <?php for ($x = 0; $x <= 12; $x++) { echo ' <option value="' . $x . '">Card ' . $x . '</option> '; }; ?> </select> </div> </div> <div class="col-md-2"> <div class="form-group"> <label>Pin card from:</label> <div class="input-group date" id="reservationdatetimeFF' + room +'" data-target-input="nearest"> <input type="datetime-local" class="form-control" name="pinFromm' + room +'" placeholder="From" /> <div class="input-group-append" data-target="#reservationdatetimeFF' + room +'" data-toggle="datetimepicker"> </div> </div> </div> </div> <div class="col-md-2"> <div class="form-group"> <label>Pin card to:</label> <div class="input-group date" id="reservationdatetimeTT' + room +'" data-target-input="nearest"> <input type="datetime-local" class="form-control" name="pinToo' + room +'" placeholder="To" /> <div class="input-group-append" data-target="#reservationdatetimeTT' + room +'" data-toggle="datetimepicker"> </div> </div> </div> </div> <div class="col-md-1"> <div class="form-group"> <label>Remove:</label> <div class="form-group"> <button type="button" class="btn btn-danger remove_block"> <i class="fas fa-trash"></i> </button> </div> </div> </div> </div> <hr />'
;
        objTo.appendChild(divtest)
    }
var wrapper = $("#room_fileds"); //Fields wrapper
    $(wrapper).on("click",".remove_block", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').parent('div').parent('div').parent('div').remove(); x--;
    })

</script>
<script>
<?php
 foreach($pin as $row){
  if($row['active'] != 1){
    $disabled = 'disabled';
  }
  else{
    $disabled = '';
  }
echo "
//Date and time picker
$('#reservationdatetimeF".$row['id']."').datetimepicker({ sideBySide: true, icons: { time: 'far fa-clock' } });

  //Date and time picker
$('#reservationdatetimeT".$row['id']."').datetimepicker({ sideBySide: true, icons: { time: 'far fa-clock' } });

";
}
?>

<?php
////////////////////////////////////////////////////////////pin pages
for ($x = 0; $x <= 40; $x++){
echo "
//Date and time picker
$('#reservationdatetimeFF".$x."').datetimepicker({ sideBySide: true, icons: { time: 'far fa-clock' } });

  //Date and time picker
$('#reservationdatetimeTT".$x."').datetimepicker({ sideBySide: true, icons: { time: 'far fa-clock' } });

";
}
?>
$('#postdatetime').datetimepicker({
   icons: { time: 'far fa-clock' },
   //inline: true,
  sideBySide: true,
  useCurrent: true,
  });
    </script>
<script>
        function show() {
 
            /* Get image and change value
            of src attribute */
            let image = document.getElementById("hoImage");
 
            image.src = this.value;
      
        }
        document.getElementById("preSelectLogo").onchange = show;
        document.getElementById("preSelectFlag").onchange = show;
    </script>
<script>
$(function () {
 
  $('#newsAdd').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>  
<script>

function preSelectA(){
    document.getElementById('authorA').style.display = "";
    document.getElementById('authorB').style.display = "none";
    document.getElementById('addNewAuthor').name = "";
    document.getElementById('preSelectAuthor').name = "author";
}
function addNewA(){
    document.getElementById('authorB').style.display = "";
    document.getElementById('authorA').style.display = "none";
    document.getElementById('addNewAuthor').name = "author";
    document.getElementById('preSelectAuthor').name = "";
}


function flagA(){
    document.getElementById('preSelectFlagA').style.display = "";
    document.getElementById('preSelectLogoA').style.display = "none";
    document.getElementById('preSelectFlag').name = "title_badge";
    document.getElementById('preSelectLogo').removeAttribute("name"); 
   document.getElementById('hoImage').style.display = "";
}
function logoA(){
    document.getElementById('preSelectLogoA').style.display = "";
    document.getElementById('preSelectFlagA').style.display = "none";
    document.getElementById('preSelectLogo').name = "title_badge";
    document.getElementById('preSelectFlag').removeAttribute("name");
    document.getElementById('hoImage').style.display = ""; 
}
function titleBadgeHide(){
    document.getElementById('preSelectFlag').removeAttribute("name"); 
    document.getElementById('preSelectLogo').removeAttribute("name"); 
    document.getElementById('preSelectLogoA').style.display = "none";
    document.getElementById('preSelectFlagA').style.display = "none";
    document.getElementById('hoImage').style.display = "none";
    document.forms["articleForm"]["title_badge"].value = "null";  

}
</script>
<script>
$(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
</script>
<script>
               // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template2")
previewNode.id = ""
var previewTemplate = previewNode.parentNode.innerHTML
previewNode.parentNode.removeChild(previewNode)

var myDropzone = new Dropzone(".dropzone", { // Make the whole body a dropzone
 //url: "library/logo_view_process.php", // Set the url
  // method: "post",
  thumbnailWidth: 80,
  thumbnailHeight: 80,
  parallelUploads: 20,
  previewTemplate: previewTemplate,

  maxFiles: 1,
  autoQueue: false, // Make sure the files aren't queued until manually added
  previewsContainer: "#previews", // Define the container to display the previews
  clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
  paramName: "image", // The name that will be used to transfer the file
  maxfilesexceeded: function(){
    const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
timerProgressBar: true,
didOpen: (toast) => {
  toast.addEventListener('mouseenter', Swal.stopTimer)
  toast.addEventListener('mouseleave', Swal.resumeTimer)
}
})

Toast.fire({
icon: 'error',
title: 'Maximum files allowed is 1.'
})
  },


})

myDropzone.on("addedfile", function(file) {
  // Hookup the start button
  file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
})

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
  document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
})

myDropzone.on("sending", function(file) {
  // Show the total progress bar when upload starts
  document.querySelector("#total-progress").style.opacity = "1"
  // And disable the start button
  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
})

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
  document.querySelector("#total-progress").style.opacity = "0"
})

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#logoUpload .startt").onclick = function() {
  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
}
document.querySelector("#logoUpload .cancel").onclick = function() {
  myDropzone.removeAllFiles(true)
}
// DropzoneJS Demo Code End
          </script>
<script>
document.getElementById('uploadButton').onclick = function(){
//validation 
/////////////////////////////////////////////////title
var title = document.getElementById("title").value;
if (title.length == 0) {
    alert("Title field has not been filled!");
   return;
 } 
//////////////////////////////////////////////////////
var source = document.getElementById("source").value;
if (source.length == 0) {
    alert("Source field has not been filled!");
   return;
 } 
//////////////////////////////////////////////////////
var deep_link = document.getElementById("deep_link").value;
if (deep_link.length == 0) {
    alert("Deep Link field has not been filled!");
   return;
 } 
//////////////////////////////////////////////////////
 var category = document.getElementById("source").value;
if (category.length == 0) {
    alert("Category field has not been filled!");
   return;
 } 

//////////////////////////////////////////////////////
var author = document.forms["articleForm"]["author"].value;
var author_2 = document.getElementById("preSelectAuthor").value;
if (author_2 == "Select Author" && author.length == 0) {
    alert("Author field has not been filled!");
   return;
 } 

//////////////////////////////////////////////////////
var content = document.forms["articleForm"]["content"].value;
if (content.length == 0) {
    alert("Content field has not been filled!");
   return;
 } 

//////////////////////////////////////////////////////
var frame_color = document.forms["articleForm"]["frame_color"].value;
if (frame_color.length == 0) {
    alert("Please Choose a color for the frame!");
   return;
 } 

//////////////////////////////////////////////////////
var tag_1 = document.forms["articleForm"]["tag_a"].value;
if (tag_1.length == 0 || tag_1 == "") {
    alert("Tag 1 field has not been filled!");
   return;
 } 
//////////////////////////////////////////////////////
var tag_2 = document.forms["articleForm"]["tag_b"].value;
if (tag_2.length == 0) {
    alert("Tag 2 field has not been filled!");
   return;
 } 
//////////////////////////////////////////////////////
var tag_3 = document.forms["articleForm"]["tag_3"].value;
if (tag_3.length == 0) {
    alert("Tag 3 field has not been filled!");
   return;
 } 

//////////////////////////////////////////////////////
var title_badge = document.forms["articleForm"]["title_badge"].value;
if (title_badge.length == 0) {
  document.forms["articleForm"]["title_badge"].value = "null";
  //  alert("Title badge has not been choosen!");
  // return;
 } 
//////////////////////////////////////////////////////
//alert(title_badge);
//  return;
///////////////////////////////////
  document.querySelector("#uploadButton").setAttribute("disabled", "disabled")
    const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
timerProgressBar: true,
capture: "image/*",
acceptedFiles: "image/*",
didOpen: (toast) => {
  toast.addEventListener('mouseenter', Swal.stopTimer)
  toast.addEventListener('mouseleave', Swal.resumeTimer)
}
})

Toast.fire({
icon: 'info',
title: 'Your data has been processed!'
})
myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
setTimeout(function() {
    myDropzone.removeAllFiles(true);
    document.querySelector("#uploadButton").removeAttribute("disabled", "disabled")
    //logoImage.hide();
    window.location.replace("manual_view.php");
    }, 2000);

    }
</script>
<script>
  function contentTyp(){
    var x = document.getElementById("contSel").value;  
    if(x == 'video'){
      document.getElementById('videoRow').style.display = "";
    }
    else{
      document.getElementById('videoRow').style.display = "none";     
    }
  }
</script>
<?php
include 'components/alert.php';
?>
</body>
</html>
