<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';
	
	if(isset($_POST['activate'])){

		$email = $_POST['email'];
        $repassword = $_POST['repassword'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
	    $code = $_POST['code'];
        $user = $_POST['user'];

	$conn = $pdo->open();

    if($password != $repassword){	
        $_SESSION['error'] = 'Passwords did not match';
      header('location: activate.php?code='.$code.'&user='.$user);
    }   
    else{			
		//$_SESSION['error'] = 'bypassed';
				$password = password_hash($password, PASSWORD_DEFAULT);
		
				try{
					$conn = $pdo->open();
					$stmt = $conn->prepare("UPDATE users SET firstname=:firstname, lastname=:lastname, password=:password, status=:status WHERE id=:id");
					$stmt->execute(['lastname'=>$lastname, 'firstname'=>$firstname, 'password'=>$password, 'id'=>$user, 'status'=>2]);
					//$userid = $conn->lastInsertId();
					$stmt2 = $conn->prepare("SELECT * FROM mail WHERE name=:name");
					$stmt2->execute(['name'=>'registration']);
					$mail_config = $stmt2->fetch();
                    $message = "
                    <div style='background-color:#fff; width:100%; display:flex; align-items:center; font-family: Tahoma, sans-serif;'>
                    <div data-template-type='html' style='float:right; align-items:center; display:block; background-color:#fff; border-color:#ffcc00; border-radius:7px; font-family: Georgia; width:750px; padding:30px' class='ui-sortable'> 
                                     
                                     <h2 style='text-align:center;color:#0057b7'>Thank you for Joining<br /> Ukrzmi. <br /><br />Profitable Opportunities are Waiting for you.</h2>
                                     <hr />
                                    
                                        <p style='text-align:left; width:500px;'>Hello, ".$firstname.", 
                                        <br/><br/>
                                        <p style='text-align:justify;'>
                                        Full registration successful.  <br /><br /> You can now login to your account under the email <b>".$email."</b>.
                                        </p>
                                        </p>
                                        
                                        
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

				        {$_SESSION['success'] = 'Account activated.';
				       header('location: login.php');
					}

				    } 
									
				    catch (Exception $e) {
				        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				        header('location: activate.php?code='.$code.'&user='.$user);
				    }

				}
				catch(PDOException $e){
/* lllllll */	$_SESSION['error'] = $e->getMessage();
             // $_SESSION['error'] = 'Error with query';
				header('location: activate.php?code='.$code.'&user='.$user);
				}

				$pdo->close();

			

    }

	}
	else{
		$_SESSION['error'] = 'Activation form error!';
		header('location: activate.php?code='.$code.'&user='.$user);
	}