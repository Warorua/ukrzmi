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
            <h1 class="m-0">Add new block</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Block Add</li>
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
   <form id="newsAdd" action="block_system/block_add_process.php"  method="post" enctype="multipart/form-data">

  

          <!-- general form elements -->
          <div class="card card-primary">
                            <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
                <h3 class="card-title">Meta Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">
                 <div class="form-group">
                    <label for="exampleInputEmail1">Block Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Block Title" required>
                  </div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
                    <label for="exampleInputEmail1">Article size</label>
                    <input type="number" class="form-control" name="size" placeholder="Number of articles to be in the block" max="64" min="8"  required>
 </div>
</div>
<div class="col-md-4">
<div class="form-group">
                    <label for="exampleInputEmail1">Position</label>
                    <div class="form-group">
            
                  <select class="form-control select2bs4" data-placeholder="Enter keywords" name="position" style="width: 100%;"  required>
                    <option value="0">Top(Headlines)</option>
                    <option value="1">Position 2</option>
                    <option value="2">Position 3</option>
                    <option value="3">Position 4</option>
                    <option value="4">Position 5</option>
                    <option value="5">Position 6</option>
                    <option value="6">Position 7</option>
                    <option value="7">Position 8</option>
                    <option value="8">Position 9</option>
                    <option value="9">Last Position</option>
                  </select>
                </div> 
                  </div>

</div>
<div class="col-md-4">
<label for="exampleInputEmail1">Status</label>
<div class="form-group">
            
            <select class="form-control select2bs4" data-placeholder="Block Status" name="status" style="width: 100%;"  required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>        
            </select>
          </div> 
           
</div>
</div>
<div class="form-group">
                    <label for="exampleInputEmail1">Category Content</label>
                    <div class="form-group">
            
                  <select class="form-control select2" data-placeholder="Enter keywords" name="type" style="width: 100%;"  required>
 <?php
$stmt = $conn->prepare("SELECT DISTINCT category FROM news");
$stmt->execute();
$cat = $stmt->fetchAll();
foreach($cat as $row){
    $stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM blocks WHERE type=:type");
    $stmt->execute(['type'=>$row['category']]);
    $cat_count = $stmt->fetch();
    if($cat_count['numrows'] > 0){
        echo '<option disabled="disabled">'.$row['category'].' <b class="bg-secondary">(Unavailable)</b></option>';
    }
    else{
        echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';
    }
}
 ?>
                  </select>
                </div> 
                  </div>

                </div>
                <!-- /.card-body -->

  
            </div>
            <!-- /.card -->




<!-- Color Frame Picker -->
  <div class="card card-primary card-outline">
                        <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
            <h3 class="card-title">
              <i class="fa fa-object-group"></i>
              Block Background Color
            </h3>
          </div>
          <div class="card-body">        

            <div class="tab-content" id="custom-content-above-tabContent">
<!-- Color Picker -->
<div class="form-group">
                  <label>Color picker:</label>

                  <div class="input-group my-colorpicker2">
                    <input type="text" class="form-control" name="color"  required>

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
 <!-- /.form group -->
          </div>
 <button class="btn btn-success" type="submit">Add Block</button>         
          </div>
          <!-- /.card -->
        </div>
<!-- Color Picker -->




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
$(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
</script>
<?php
include 'components/alert.php';
?>
</body>
</html>
