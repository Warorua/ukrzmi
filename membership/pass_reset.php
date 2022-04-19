<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['reset'])){
		$email = $_POST['email'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			//generate code
			$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code=substr(str_shuffle($set), 0, 15);
			try{
				$stmt = $conn->prepare("UPDATE users SET reset_code=:code WHERE id=:id");
				$stmt->execute(['code'=>$code, 'id'=>$row['id']]);
				
				$stmt2 = $conn->prepare("SELECT * FROM mail WHERE name=:name");
				$stmt2->execute(['name'=>'account_recovery']);
				$mail_config = $stmt2->fetch();


				$message = "
					<h1>".$mail_config['head']."</h1>
					<h2>Your Account:</h2>
					<p>Email: ".$email."</p>
					<div>".$mail_config['top_body']."</div>
					<p>Please click the link below to reset your password.</p>
					<button style=' padding: 0.5rem; border-radius:3px; background-color:#ffcc00; border:none; margin-left:45%;'>
					  <a style='text-decoration:none; color:white' href='https://www.ukrzmi.com/membership/password_reset.php?code=".$code."&user=".$row['id']."'>Reset Password</a>
					 </button>
					 <div>".$mail_config['bottom_body']."</div>
				";

				//Load phpmailer
		    		require 'vendor/autoload.php';

		    		$mail = new PHPMailer(true);                             
				    try {
				        //Server settings
					
				        $mail->isSMTP();                                     
				        $mail->Host = gethostbyname($mail_config['host']);                  
				        $mail->SMTPAuth = true;                               
				        $mail->Username = $mail_config['mail'];     
				        $mail->Password = $mail_config['mail_password'];                    
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
				        );                         
				        $mail->SMTPSecure = 'tls';                           
				        $mail->Port = $mail_config['port'];                                   

				        $mail->setFrom($mail_config['set_from']);
				        
				        //Recipients
				        $mail->addAddress($email);              
				        $mail->addReplyTo('waroruaalex@tsavo.store');
				       
				        //Content
				        $mail->isHTML(true);                                  
				        $mail->Subject = $mail_config['subject'];
				        $mail->Body    = $message;

				        $mail->send();


			        $_SESSION['success'] = 'Password reset link sent to your email';
			     
			    } 
			    catch (Exception $e) {
			        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
			    }
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}
		else{
			$_SESSION['error'] = 'Email not found';
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Input email associated with account';
	}

	header('location: forgot_pass.php');

?>