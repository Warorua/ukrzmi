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
$mynav = $_SERVER['PHP_SELF'];
$my_link = basename($mynav);
?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Registration Mail Setting</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Registration</li>
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
   <form id="newsAdd" action="mail_config/mail_reg_process.php"  method="post" enctype="multipart/form-data">

  

          <!-- general form elements -->
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Mail setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">
                    <div class="row">

                    <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Host</label>
                    <input type="text" class="form-control" name="host" placeholder="Host" required>
                  </div>   

                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Mail</label>
                    <input type="email" class="form-control" name="mail" placeholder="Mail" required>
                </div>
         <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Mail Password</label>
                    <input type="text" class="form-control" name="mail_password" placeholder="Mail Password" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Mail Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="Mail Subject" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Port</label>
                    <input type="number" class="form-control" placeholder="587" disabled>
                    <input type="hidden" name="port" value="587"/>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Set From Mail</label>
                    <input type="email" class="form-control" name="set_from"  placeholder="Set From Mail" required>
                </div>



                    </div>
<!-- /.card-body -->

  
            </div>
            <!-- /.card -->
        
       </div>

                <!-- general form elements -->
                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Mail body setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">
                 <div class="form-group">
                    <label for="exampleInputEmail1">Target Process</label>
                    <input type="text" class="form-control" name="name" placeholder="Target SMTP Process">
                    <input type="hidden" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Heading</label>
                    <input type="text" class="form-control" name="head" placeholder="Heading" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sub-heading</label>
                    <input type="text" class="form-control" name="sub_head" placeholder="NULL" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Top Body</label>
                   <textarea id="summernote" class="form-control" name="top_body" style="width:100%; height:150px"  required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Bottom Body</label>
                   <textarea id="summernote2" class="form-control" name="bottom_body" style="width:100%; height:150px"></textarea>
                </div>
                <input type="hidden" name="sender" value="<?php echo $my_link ?>"/>
              <!-- /.card-body -->
 <div class="col-md-4">
                 <button class="btn btn-success" name="submit" type="submit">Submit</button>
            </div>
  
            </div>   
           
            
            <!-- /.card -->
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
