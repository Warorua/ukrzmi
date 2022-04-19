<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['signup'])){

		$email = $_POST['email'];
	

	$conn = $pdo->open();

			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			if($row['numrows'] > 0){
				$_SESSION['error'] = 'Email already taken';
				header('location: register.php');
			}
			else{
				$now = date('Y-m-d');
				//$password = password_hash($password, PASSWORD_DEFAULT);

				//generate code
				$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code=substr(str_shuffle($set), 0, 12);

				try{
					$stmt = $conn->prepare("INSERT INTO users (email, activate_code, created_on) VALUES (:email, :code, :now)");
					$stmt->execute(['email'=>$email, 'code'=>$code, 'now'=>$now]);
					$userid = $conn->lastInsertId();

					
				$stmt2 = $conn->prepare("SELECT * FROM mail WHERE name=:name");
				$stmt2->execute(['name'=>'registration']);
				$mail_config = $stmt2->fetch();

                    $message = "
                    <div style='background-color:#fff; width:100%; display:flex; align-items:center; font-family: Tahoma, sans-serif;'>
                    <div data-template-type='html' style='float:right; align-items:center; display:block; background-color:#fff; border-color:#ffcc00; border-radius:7px; font-family: Georgia; width:750px; padding:30px' class='ui-sortable'> 
                                     
                                     <h2 style='text-align:center;color:#0057b7'>".$mail_config['head']."</h2>
                                     <hr />
                                    
									 ".$mail_config['top_body']."
                                        
                                        <hr />
										".$mail_config['bottom_body']."
                                             <br />
                                         
                                          <a style='width:100%; padding: 0.5rem; border-radius:3px; background-color:#0057b7; border:none;text-decoration:none; color:white; text-align:center' href='https://www.ukrzmi.com/membership/activate.php?code=".$code."&user=".$userid."'>Activate Account</a>
                                         
                                         <br />
                                          <br />
                                         
                                         <hr />
                                         <table style='width:100%'>
                    <th>
                    <td></td>
                    <td></td>
                    </th>
                    
                    <tr>
                    <td style='height:20px; width:75%; color:#838694'>
                    <small style='height:10px; margin-top:0px; margin-bottom:0px'>800 SE 4th AveSte. 604B, Hallandale Florida, 33009</small><br />
                    <small style='height:10px; margin-top:0px; margin-bottom:0px'><a href='https://ukrzmi.com/terms'>Terms of Service</a> | <a href='https://ukrzmi.com/privacy-policy'>Privacy Policy</a></small><br />
                    <small style='height:10px; margin-top:0px; margin-bottom:0px'>© ".$year." Ukrzmi. All rights reserved</small>
                    </td>
                    <td style='width:25%'>
                    <div style='width:100%; margin-right:50px'>
                    <small><a href=''><img style='width:25%; float:right; margin-right:5px' src='https://ukrzmi.com/reg/icon/fb.png' /></a></small>
                    <small><a href='https://www.linkedin.com/company/nxt-acquisitions-corp/?viewAsMember=true'><img style='width:25%; float:right; margin-right:5px' src='https://ukrzmi.com/reg/icon/link.png' /></a></small>
                    <small><a href='https://www.instagram.com/ukrzmi/'><img style='width:25%; float:right; margin-right:5px' src='https://ukrzmi.com/reg/icon/ig.png' /></a></small>
                    </div>
                    </td>
                    </tr>
                    
                    </table> 
                                        </div>
                    </div>
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

				        unset($_SESSION['email']);

				        {$_SESSION['success'] = 'Account created. Check your email to activate.';
				        header('location: register.php');}

				    } 
									
				    catch (Exception $e) {
				        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: register.php');
				    }

				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: register.php');
				}

				$pdo->close();

			}

		

	}
	else{
		$_SESSION['error'] = 'Complete filling the signup form first';
		header('location: register.php');
	}