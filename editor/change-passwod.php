<?php require_once('header.php'); 
require_once('config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../login/include/db2.php');
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['submit'])){

     $n_password = $_POST['n_password'];
     $c_password = $_POST['c_password'];

     if(empty($n_password)){
          $msg = 'Please Type Your Password';
     }
     else if($n_password != $c_password){
          $msg = 'Re-typeable Password is not match';
     }
     else{
          $email = $_SESSION['username'];
          $dbPassowd = md5($c_password);
          $fname = $_SESSION['fname'];

        $stm = $pdo->prepare("UPDATE ejournal_users SET password=? WHERE email=?");
		$stm->execute(array($dbPassowd,$email));

         
          $lastID = $DB->lastInsertId();
          
                $message = '<html><head>
                        <title>ASUU - Journal</title>
                        </head>
                        <body>';
                $message .= '<h1>Hello ' . $fname . '!</h1>';
                $message .= '<p> Thank you for Getting in Touch Academic Staff Union of Universities E-journal, Your password has been changed successfully.' .  '</p>';
                $link = 'https://ejournals.asuu.org.ng/login/';
                $message .="<a href = ''></a>"; 
                $message .= '<p> Here are your new login password
                
                           <ul> 
                           <li>Click the Link to Login : ' . $link . ' </li>
                           <li>New Password : ' . $c_password . ' </li>
                </p>';
                
                
                echo '<br>';
                
                $message .= '<p>Thank you, <br> Ejournal Academic Staff Union of Universities
                
                </p>';
                $message .= "</body></html>";
                
          
                // php mailer code starts
				$mail = new PHPMailer();
				$mail->Encoding = "base64";
				$mail->SMTPAuth = true;
				$mail->Host = "smtp.zeptomail.com";
				$mail->Port = 587;
				$mail->Username = "emailapikey";
				$mail->Password = 'wSsVR60k/h/zCal/zTf/Lu07nlpVVV+jFxx1iQPyunP6Sq3F9sdpwxfKUQb0GPdJEWBrHGZHrb8smxYBhzQO2tokn1kJDiiF9mqRe1U4J3x17qnvhDzDWG9elxCLKoMAxgpsmWhlEs4n+g==';
				$mail->SMTPSecure = 'TLS';
				$mail->isSMTP();
				$mail->IsHTML(true);
				$mail->CharSet = "UTF-8";
				$mail->From = "noreply@asuu.org.ng";
				$mail->addAddress($email);
				$mail->Subject="Your password has been changed successfully.";
				$mail->SMTPDebug = 0;
				$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str"; echo "<br>";};
                $mail->MsgHTML($message);
          
                try {
                  $mail->send();
                  $msg2 = "Successfully change your password";
                  $msgType = "success";
                } catch (Exception $ex) {
                  $msg = $ex->getMessage();
                  $msgType = "warning";
                }
           
          
     }




}


?>
<link rel="stylesheet" type="text/css" href="css/component.css" />
<style>
	.right_section {
		background: #eee;
		padding: 30px 70px;
		border-radius: 6px;
	}
	.form-group {
		margin-bottom: 2rem;
	}
	.site-footer {
		margin-top: 42px;
	}
	.inputfile + label {
	font-size: 16px;
	font-weight: 400;
	white-space: nowrap;
	cursor: pointer;
	/* padding-bottom: 40px; */
	/* line-height: 41px; */
	padding: 5px 16px;
	max-width: 100%;
}
.inputfile + label svg {
	width: 2em;
	height: 2em;
	vertical-align: middle;
	fill: currentColor;
	margin-top: -0.25em;
	margin-right: 0.25em;
}
.inputfile-2 + label {
	color: #d3394c;
	border: 1px solid currentColor;
}
.form-control {
	border: 1px solid #DC143C;
}
.btn-outline-primary {
	border-color: #DC143C;
}
.custom-select {
	border: 1px solid #DC143C;
}
</style>



<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

		<main class="main_content">
			<div class="container">

			
           


				<div class="row justify-content-center">
					<div class="col-lg-10">
						<div class="row justify-content-center pt-5 ">
						

							<!-- right section -->
							<div class="col-lg-8">
								<div class="right_section">
									<div class="journals_filter text-center">
									  
										<h4>Change Your Password</h4>
									</div>
                                   
							<div>   
								<form action="" method="POST" enctype="multipart/form-data">

                                        <?php 
			
			if (isset($msg)){
                   	echo "<div class='alert alert-danger'><strong>Error: $msg </strong> </div>";
                   
                } else {
                        if (isset($msg2))
                    	echo "<div class='alert alert-success'><strong> $msg2 </strong> </div>";
                   
                }
			
			
			
			
			?>
									
									<div class="form-group">
										<input class="form-control" type="password" id="" name="n_password" placeholder="Type New Password" required>
									</div>
                                             <div class="form-group">
										<input class="form-control" type="password" id="" name="c_password" placeholder="Re-type Your new Password" required>
									</div>
									
									
                                  			<div class="form-group text-center mb-3">
									    <input name="submit" class="btn btn-outline-primary btn-lg btn-block" type="submit">
									</div>
                                		</form>
                                	</div>


								</div>
							</div>


						</div>
					</div>
					

					

				</div>
			</div>
		</main>
<br />


	</div>

	<script src="js/custom-file-input.js"></script>
	<?php require_once('footer.php'); ?>