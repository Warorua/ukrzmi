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
<html id="Stencil" class="no-js light-theme ">
    
<!-- Mirrored from login.yahoo.com/account/create?.intl=in&specId=yidReg&done=https%3A%2F%2Fwww.yahoo.com by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Mar 2022 15:19:45 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="referrer" content="origin">
        <title>Ukrzmi</title>
        <link rel="dns-prefetch" href="http://gstatic.com/">
        <link rel="dns-prefetch" href="http://google.com/">
        <link rel="dns-prefetch" href="http://s.yimg.com/">
        <link rel="dns-prefetch" href="http://y.analytics.yahoo.com/">
        <link rel="dns-prefetch" href="http://ucs.query.yahoo.com/">
        <link rel="dns-prefetch" href="http://geo.query.yahoo.com/">
        <link rel="dns-prefetch" href="http://geo.yahoo.com/">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
        <style nonce="zrksOkq+9CAUvYmcmzOTAn4zxinc07U375BZapynOS3yH6rN">
            #mbr-css-check {
                display: inline;
            }
            
            .topLogo {
        background-color: #000000;
        border-radius: 5px;
        color: azure;
        margin-top: 4px;
        margin-bottom: 4px;
        height: 39px;
        width: 39px;
        margin-left: 20px;
        text-align: center;
        padding-top: 3px;
        font-size: 22px;
    }

    .topLogoText {
        margin-top: 10px;
        color: #000000;
    }
        </style>
        <link href="../bower/yahoo-main.css" rel="stylesheet" type="text/css">
     
    </head>
    <body class="bucket-">

    <div id="login-body" class="loginish dark-background puree-v2    ">
    <div class="mbr-desktop-hd">

    <span class="column">
    <img src="../bower/logo.PNG" alt="Yahoo" class="logo " width="" height="55" />  
    </span>



    <span class="column help txt-align-right">
        <a href="https://help.yahoo.com/kb/index?locale=en_IN&amp;page=product&amp;y=PROD_ACCT">Help</a>
    </span>
</div>
    <div class="login-box-container">
        <div class="login-box center">
            <div id="account-attributes-challenge"  class="">
            <h1 class="txt-align-center header-text">Sign up</h1>
                <p class="text-sm m-t-8px txt-align-center yid-reg-sub-heading">Finish your Registration</p>
            
    <form id="regform" action="activate_process.php" class="pure-form pure-form-stacked oneid-form-background reg-form grid-form" method="post" novalidate >
        <fieldset>
            <div id="usernamereg-fullname" class="pure-g name-field field-group  ">
                <div class="first-name pure-u-1-2">
                    <input type="text" id="usernamereg-firstName" class="ureg-fname input-with-icon icon-name " autocomplete="given-name" name="firstname" placeholder="First name" aria-label="First name" value="" maxlength="32"  aria-required="true"   data-rapid-tracking="true" data-ylk="elm:input;elmt:fname;slk:first-name;"  <?php echo $input_output ?> required>
                    <div role="alert" id="reg-error-firstName"></div>
                </div>
                <div class="last-name pure-u-1-2">
                    <input type="text" id="usernamereg-lastName" class="ureg-lname " name="lastname" autocomplete="family-name" placeholder="Lastname" aria-label="Surname" value="" maxlength="32"  aria-required="true"   data-rapid-tracking="true"  data-ylk="elm:input;elmt:lname;slk:last-name;"  <?php echo $input_output ?> required>
                    <div role="alert" id="reg-error-lastName"></div>
                </div>
            </div>
        </fieldset>
        <div id="yid-field-suggestion">
            
            <div class="margin8 yid-field">
                <input type="text"  value="<?php echo $email ?>" disabled  id="usernamereg-yid" autocomplete="username" placeholder="Email address"
                aria-label="Email address" value="" maxlength="32"  aria-required="true"   data-rapid-tracking="true"  data-ylk="elm:input;elmt:yid;slk:yid;">        
                <input type="hidden" name="email" value="<?php echo $email ?>" > 
              </div>

            <div role="alert" id="reg-error-yid"></div>
            <div class="desktop-suggestions-container" id="desktop-suggestions-container" aria-live="polite">
                <ul class="desktop-suggestion-list" id="desktop-suggestion-list" role="menu"
                    data-msg-domain-default="Available usernames {atDomainName}"
                ></ul>
            </div>
            
            </div>
        <div class="password-field " id="password-container">
            <input type="password" id="usernamereg-password"  autocomplete="new-password" name="password" placeholder="Password" aria-label="Password" maxlength="128"  aria-required="true"  <?php echo $input_output ?> required  >
            <input type="button" tabindex="-1" value='show' id="usernamereg-show-button">
        </div>
        <div id="reg-error-password"></div>

        <div class="password-field " id="password-container">
            <input type="password" id="usernamereg-password"  autocomplete="new-password" name="repassword" placeholder="Repeat Password" aria-label="Password" maxlength="128"  aria-required="true"  <?php echo $input_output ?> required  >
            <input type="button" tabindex="-1" value='show' id="usernamereg-show-button">
        </div>

          <p class="m-t-24px tos ">
                    By clicking "Continue", you agree to the <a href="https://legal.yahoo.com/in/en/yahoo/terms/otos/index.html" data-rapid-tracking="true" data-ylk="subsec:toslink;elm:link;elmt:terms;slk:terms;mKey:terms" class="termsLink" target="_blank">Terms <strong class="tos-updated"></strong></a> and <a href="https://legal.yahoo.com/in/en/yahoo/privacy/index.html" data-rapid-tracking="true" data-ylk="subsec:toslink;elm:link;elmt:privacy;slk:privacy;mKey:privacy" class="privacyLink" target="_blank">Privacy Policy <strong class="tos-updated"></strong></a>
            </p>
        <div class="cta-container">
            <button id="reg-submit-button" name="activate" type="submit" data-rapid-tracking="true" data-ylk="elm:btn;elmt:nxt;slk:continue;mKey:continue" class="pure-button puree-button-primary puree-spinner-button  <?php echo $input_output ?>" >Continue</button>
        </div>
             </form>
</div>
        </div>
        <div id="login-box-ad-fallback" class="login-box-ad-fallback">
            
        </div>
    </div>
    <div class="login-bg-outer">
        <div class="login-bg-inner">
                <div id="login-ad-rich"></div>
                    </div>
    </div>
    
</div>
    <script src="../bower/rapid-3.53.30.js"></script>
    <script nonce="zrksOkq+9CAUvYmcmzOTAn4zxinc07U375BZapynOS3yH6rN">
        var rapidInstance = new YAHOO.i13n.Rapid(I13N_config);
    </script>
    <script src="../bower/bundle.js"></script>
    <noscript>
        <img src="https://login.yahoo.com/account/js-reporting/?crumb=dhesCW4p90c&amp;message=javascript_not_enabled&amp;ref=%2Faccount%2Fcreate" height="0" width="0" style="visibility: hidden;">
    </noscript>
    <script nonce="zrksOkq+9CAUvYmcmzOTAn4zxinc07U375BZapynOS3yH6rN">
        var checkAssets = function(seconds) {
            setTimeout(function() {
                if (!window.mbrJSLoaded) {
                    window.mbrSendError('js_failed_to_load', location.pathname);
                }
                var check = document.getElementById('mbr-css-check'),
                    style = check.currentStyle;
                if (window.getComputedStyle) {
                    style = window.getComputedStyle(check);
                }
                if (style.display !== 'none') {
                    window.mbrSendError('css_failed_to_load', location.pathname);
                }
            }, (seconds * 1000));
        };

        checkAssets(10);
    </script>
  

  <script src="../bower/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../bower/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

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

<!-- Mirrored from login.yahoo.com/account/create?.intl=in&specId=yidReg&done=https%3A%2F%2Fwww.yahoo.com by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Mar 2022 15:19:49 GMT -->
</html>
<!-- fe40.member.bf1.yahoo.com - Mon Mar 28 2022 15:19:44 GMT+0000 (Coordinated Universal Time) - (1ms) -->