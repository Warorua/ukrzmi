<?php
include 'includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ukrzmi | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../bower/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../bower/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../bower/index2.html" class="h1">Ukrzmi</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login</p>

      <form id="loginForm" method="POST" action="verify.php">

      <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
       <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
 
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="login" id="agreeTerms" value="agree"  required>
              
              <label for="agreeTerms">
               Remember me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block ">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="register.php" class="text-center">I dont have a membership</a>
      <br/>
      <a href="forgot_pass.php" class="text-center">Forgot password.</a>
      <br/>
      <a href="../desktop/home.php" class="text-center">Home</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../bower/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../bower/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../bower/dist/js/adminlte.min.js"></script>
<!-- jquery-validation -->
<script src="../bower/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../bower/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	function showPassword() {
  var x = document.getElementById("exampleInputPassword1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
 var y = document.getElementById("exampleInputPassword2");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  } 
}
	</script>
 <script>
$(function () {
 
  $('#loginForm').validate({
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
      element.closest('.input-group').append(error);
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

  
  <?php
//$_SESSION['error'] = 'Test error';
//$_SESSION['success'] = 'Test success';
      if(isset($_SESSION['error'])){
        echo "         
  <script>
  $( document ).ready(function() {
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
  title: '".$_SESSION['error']."'
})
}); 
      
  </script>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "

  <script>
  $( document ).ready(function() {
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
  icon: 'success',
  title: '".$_SESSION['success']."'
})
}); 
      
  </script>
       ";
        unset($_SESSION['success']);
      }

      if(isset($_SESSION['user'])){
          $footer = '<a class="btn btn-success btn-sm" href="logout.php">Logout</a>';
        echo "         
  <script>
  $( document ).ready(function() {
 const Toast = Swal.mixin({
  toast: true,
  position: 'top-start',
  showConfirmButton: false,
  timer: 8000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'info',
  title: 'Hello ".$_SESSION['name'].",',
  footer: '".$footer."'
})
}); 
      
  </script>
        ";
      }
  ?>

</body>
</html>
