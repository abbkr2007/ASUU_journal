<!DOCTYPE html>
<html>
<head>
	<?php
	  include('include/head.php'); 
	  include('include/db2.php');
	  include('phpmailer/class.phpmailer.php');
	  include_once('../config.php');

	  if(isset($_POST['submit'])){
		  $email = $_POST['email'];
		  if(empty($email)){
			  $msg = "Please Enter Email First";
		  }
		  else{
			$alif = $pdo->prepare("SELECT fname,email FROM ejournal_users WHERE email=?");
			$alif->execute(array($email));
			$user_count = $alif->rowCount();

			if($user_count == 0){
				$msg = "That Email can't find ";
			}
			else{
				$ranpass = rand();
				$ddpass = md5($ranpass);
				$result = $alif->fetchAll(PDO::FETCH_ASSOC);
				$fname = $result[0]['fname'];
				$stm = $pdo->prepare("UPDATE ejournal_users SET password=? WHERE email=?");
				$update_pass = $stm->execute(array($ddpass,$email));

				if($update_pass == 1){
					$lastID = $DB->lastInsertId();

					$message = '<html><head>
							<title>ASUU - Journal</title>
							</head>
							<body>';
					$message .= '<h1>Hello ' . $fname . '!</h1>';
					$message .= '<p>We are happy to have you here' .  '</p>';
					$link = 'https://ejournals.asuu.org.ng/login/';
					$message .="<a href = ''></a>"; 
					$message .= '<p> Here are you Reset Password credencials
					
							<ul> 
							<li>Click the Link to Login : ' . $link . ' </li>
							<li>Username : ' . $email . ' </li>
							<li>Password : ' . $ranpass . ' </li>
					</p>';
					
					
					echo '<br>';
					
					$message .= '<p>Thank you, <br> Ejournal Academic Staff Union of Universities
					
					</p>';
					$message .= "</body></html>";
					
			
					// php mailer code starts
					$mail = new PHPMailer(true);
					$mail->IsSMTP(); // telling the class to use SMTP
			
					$mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
					$mail->SMTPAuth = true;                  // enable SMTP authentication
					$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
					$mail->Host = "smtppro.zoho.com";      // sets  s the SMTP server
					$mail->Port = 465;                   // set the SMTP port for the GMAIL server
			
					$mail->Username = 'noreply@asuu.org.ng';
					$mail->Password = 'all_Binder@#keh99akpo';
			
					$mail->SetFrom('noreply@asuu.org.ng', 'Academic Staff of Universities');
					$mail->AddAddress($email);
			
					$mail->Subject = trim("ASUU E-Journal Reset Password");
					$mail->MsgHTML($message);
			
					try {
					$mail->send();
					$msg2 = "An email has been sent to your email.";
					$msgType = "success";
					} catch (Exception $ex) {
					$msg = $ex->getMessage();
					$msgType = "warning";
					}
				}
				else{
					$msg = "Can't update the password on DB";
				}
			}





			
		  }
		 
	}
	?>
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="vendors/images/login-img.png" alt="login" class="login-img">
			<h2 class="text-center mb-30">Reset Password</h2>
			<?php if(isset($msg)): ?>
				<div class="alert alert-danger">
					<?php echo $msg; ?>
				</div>
			<?php endif; ?>
			<?php if(isset($msg2)): ?>
				<div class="alert alert-success">
					<?php echo $msg2; ?>
				</div>
			<?php endif; ?>
			<form method="POST">
				<p>Enter your Email to Send New Password </p>
				<div class="input-group custom input-group-lg">
					<input type="email" name="email" class="form-control" placeholder="Your Email">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group">
							<input style="color:#000" class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="Submit">
						</div>
					</div>
					<div class="col-md-6">
						<a class='btn  btn-lg btn-block' href="index.php">Login</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include('include/script.php'); ?>
</body>
</html>