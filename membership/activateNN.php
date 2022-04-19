<?php
include 'includes/session.php';
	//$output = '';
	if(!isset($_GET['code']) OR !isset($_GET['user'])){
        $alert_output = 'error';
         $input_output = 'disabled';
		$output = 'Code to activate account not found.'; 
	}
	else{
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE activate_code=:code AND id=:id");
		$stmt->execute(['code'=>$_GET['code'], 'id'=>$_GET['user']]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			if($row['status'] > 1){
                $alert_output = 'error';
                $input_output = 'disabled';
                $output = 'Account already activated.';
			}
			else{
				try{
					$stmt = $conn->prepare("UPDATE users SET status=:status WHERE id=:id");
					$stmt->execute(['status'=>1, 'id'=>$row['id']]);
                    $code = $_GET['code'];
                    $user = $_GET['user'];
                    $alert_output = 'success';
                    $input_output = '';
					$output = 'Account activated - Email: <b>'.$row['email'].'</b>.';
				}
				catch(PDOException $e){
                    $alert_output = 'error';
         $input_output = 'disabled';
					$output = ''.$e->getMessage().'';
				}

			}
			
		}
		else{
            $alert_output = 'error';
         $input_output = 'disabled';
			$output = 'Cannot activate account. Wrong code.';
		}

		$pdo->close();
	}
if(!isset($row['email'])){
    $email = 'No valid email';
}
else{
    $email = $row['email'];
}
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
      <p class="login-box-msg">Finish your Registration</p>

      <form id="activateForm" method="POST" action="activate_process.php">
      <div class="input-group mb-3">
          <input type="email" class="form-control" value="<?php echo $email ?>" disabled>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
   
        <div class="input-group mb-3">
          <input type="text" name="firstname" class="form-control" placeholder="First name" <?php echo $input_output ?> required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="lastname" class="form-control" placeholder="Last name" <?php echo $input_output ?> required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

       <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" <?php echo $input_output ?> required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="repassword" class="form-control" id="exampleInputPassword2" placeholder="Retype password" <?php echo $input_output ?> required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <input type="hidden" name="email" value="<?php echo $email ?>" />
        <input type="hidden" name="user" value="<?php echo $user ?>" />
              <input type="hidden" name="code" value="<?php echo $code ?>" />
          
          <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" onclick="showPassword()" <?php echo $input_output ?>>
                      <label class="custom-control-label" for="exampleCheck1">Show passwords.</label>
                    </div>
                  </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="activate" id="agreeTerms" value="agree" <?php echo $input_output ?> required>
              
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block <?php echo $input_output ?>">Activate</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="login.php" class="text-center">I already have a membership</a>
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
  $.validator.setDefaults({
    submitHandler: function () {
      const Toast = Swal.mixin({
  toast: true,
  position: 'top-start',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'info',
  title: 'Account activation in progress!'
})

e.preventDefault();
   /*             
                var email= $("input[name='email']").val();
                var firstname= $("input[name='firstname']").val();
                var lastname= $("input[name='lastname']").val();
                var code= $("input[name='code']").val();
                var user= $("input[name='user']").val();
                var password= $("input[name='password']").val();
                var repassword= $("input[name='repassword']").val();
               // var activate= $("input[name='activate']").val();
               $.ajax({
               method:"POST",
               url: "activate_process.php",
               data:{
                 email:email,
                 firstname:firstname,
                 lastname:lastname,
                 code:code,
                 user:user,
                 password:password,
                 repassword:repassword,
                 activate:activate
                  },
               success: function(data){
                  // alert("Fetch operation finished!");
             //    $("#fetchPr").html(data); 
                 
          
           }});

*/

    }
  });
  $('#activateForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
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
        echo "         
  <script>
  $( document ).ready(function() {
 const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 10000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: '".$alert_output."',
  title: '".$output."'
})
}); 
      
  </script>
        ";
       
  ?>
  
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
  ?>

</body>
</html>
