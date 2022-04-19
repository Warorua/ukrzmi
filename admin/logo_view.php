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
            <h1 class="m-0">Active Logos Library</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">logos Library</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card">
<div class="card-header">
    <a class="btn btn-app btn-warning" data-toggle="modal" data-target="#logoImage">
      <i class="fa fa-plus"></i> Add New
     </a>
</div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    
                    <th>Source</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Width</th>
                    <th>Height</th>
                    
                    <th></th>
                  </tr>
                  </thead>
                  <tbody id="logoBody">
           </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <div class="modal fade" id="logoImage">
        <div class="modal-dialog modal-lg">
            <form action="library/logo_view_process.php" class="dropzone"  method="post" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add a logo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="logoUpload">
            <div class="modal-body">
              
              <div class="form-group">
                    <label for="exampleInputEmail1">Brand Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Brand Name" required>
               </div>
               <div class="form-group">
                    <label >Source</label>
                    <select class="form-control select2bs4" id="source" name="source"  placeholder="Article Source" required>

<?php
$stmt = $conn->prepare("SELECT DISTINCT parent FROM news WHERE NOT parent=:parent ORDER BY category ASC");
$stmt->execute(['parent'=>'']);
$parent_select = $stmt->fetchAll();
foreach($parent_select as $row){
echo '
<option value="'.$row['parent'].'">'.$row['parent'].'</option>
';
}
  ?>

</select>
                  </div>
                  <div class="form-group mb-3"> 
  <select class="form-control select2bs4" id="inputGroupSelect01" name="type">
    <option selected disabled>Items</option>
    <?php
$stmt = $conn->prepare("SELECT DISTINCT type FROM news");
$stmt->execute();
$type_fetch = $stmt->fetchAll();
foreach($type_fetch as $row){
if($row['type'] == ''){
    $item_type = 'News';
    $item_type_value = '';
}
else{
    $item_type = $row['type'];
    $item_type_value = $row['type'];
}

echo '<option value="'.$item_type_value.'"'; 

echo (isset($_GET['type']) && $_GET['type'] == $item_type_value) ? 'selected' : '';

echo '>'.$item_type.'</option>';
}
    ?>
  </select>
</div>
               <!-- /.photo uplaod row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Upload logo</h3>
              </div>
              <div class="card-body">
                <div id="aactions" class="row">
                  <div class="col-lg-6">
                    <div class="btn-group w-100">
                      <span class="btn btn-success col fileinput-button">
                        <i class="fas fa-plus"></i>
                        <span>Add files</span>
                      </span>                   
                      <button type="button" class="btn btn-warning col cancel">
                        <i class="fas fa-times-circle"></i>
                        <span>Cancel upload</span>
                      </button>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center">
                    <div class="fileupload-process w-100">
                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table table-striped files" id="previews">
                  <div id="template2" class="row mt-2">
                    <div class="col-auto">
                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                    </div>
                    <div class="col d-flex align-items-center">
                        <p class="mb-0">
                          <span class="lead" data-dz-name></span>
                          (<span data-dz-size></span>)
                        </p>
                        <strong class="error text-danger" data-dz-errormessage></strong>
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary start">
                          <i class="fas fa-upload"></i>
                          <span>Start</span>
                        </button>
                        <button type="button" data-dz-remove class="btn btn-warning cancel">
                          <i class="fas fa-times-circle"></i>
                          <span>Cancel</span>
                        </button>
                        <button type="button"data-dz-remove class="btn btn-danger delete">
                          <i class="fas fa-trash"></i>
                          <span>Delete</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
        </div>
<!-- /.photo uplaod row -->
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
              <button type="reset" id="uploadButton" name="logo" class="btn btn-primary startt">
              <i class="fas fa-upload"></i>
              <span>Start upload</span>
              </button>
            </div>
        </div>
          </div>

        </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
<?php
include 'components/alert.php';
?>
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

  maxFiles: 3,
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
title: 'Maximum files allowed is 3.'
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

myDropzone.on("sending", function(file, xhr, formData) {
  //append more info
  formData.append("filesize", file.size)
  formData.append("height", file.height)
  formData.append("width", file.width)
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
    setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "library/logo_view_ajax.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#logoBody").html(data); 
         
        }
    });

}, 2000);
document.getElementById('uploadButton').onclick = function(){
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
    $('#logoImage').modal('hide');
    myDropzone.removeAllFiles(true);
    document.querySelector("#uploadButton").removeAttribute("disabled", "disabled")
    logoImage.hide();
    }, 2000);

    }
</script>
</body>
</html>
