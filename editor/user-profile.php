<?php require_once('header.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../login/include/db2.php');
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['submit'])){

     $f_name = $_POST['f_name'];
     $onames = $_POST['onames'];
     $mobile = $_POST['mobile'];
     $institute = $_POST['institute'];
     

     if(empty($f_name)){
          $msg = 'First Name is Empty';
     }
    else if(empty($onames)){
          $msg = 'Other Names is Empty';
     }
	
	else if(empty($institute)){
		$msg = 'institute is Empty';
	}
		else if(empty($mobile)){
		$msg = 'Mobile is Empty';
	}
     else{
          $email = $_SESSION['username'];
          $fname = $_SESSION['fname'];

        $stm = $pdo->prepare("UPDATE ejournal_users SET fname=?, onames=?, institution=?, phone=?  WHERE email=?");
		$stm->execute(array($f_name,$onames,$institute, $mobile,$email));

         
          $lastID = $DB->lastInsertId();
          
                $message = '<html><head>
                        <title>ASUU - Journal</title>
                        </head>
                        <body>';
                $message .= '<h1>Hello ' . $fname . '!</h1>';
                $message .= '<p> Thank you for Get in Touch Academic Staff Union of Universities E-journal, we are happy to have you here' .  '</p>';
                $message .= '<li>Your Profile Update Succesfully</li></p>';
                
                
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
				$mail->Subject="Your profile has been updated successfully.";
				$mail->SMTPDebug = 0;
				$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str"; echo "<br>";};
                $mail->MsgHTML($message);
                try {
                  $mail->send();
                  $msg2 = "Successfully change your Profile";
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
							<div class="col">
								<div class="right_section">
									<div class="journals_filter text-center">
									  
										<h4>Update Your Profile</h4>
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
			
			$alif = $pdo->prepare("SELECT * FROM ejournal_users WHERE email=?");
               $alif->execute(array($_SESSION['username']));
               $data_array = $alif->fetchAll(PDO::FETCH_ASSOC);
               $first_name = $data_array[0]['fname'];
               $m_name =  $data_array[0]['onames'];
               $institute =  $data_array[0]['institution'];
               $dbmobile =  $data_array[0]['phone'];
			
			
			?>

			 			<div class="row">
							 <div class="col-md-6">
								<div class="form-group">
									<input class="form-control" type="text" id="f_name" name="f_name" placeholder="First Name"  value="<?php echo $first_name; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
								<div class="form-group">
									<input class="form-control" type="text" id="m_name" name="onames" placeholder="Middle Name"  value="<?php echo $m_name; ?>" required>
								</div>
							 </div>
							 <!-- <div class="col-md-6">
								<div class="form-group">
									<input class="form-control" type="text" id="l_name" name="l_name" placeholder="Last Name"  value="<?php echo $last_name; ?>" required>
								</div>
							 </div> -->
							 <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="text" id="mobile" name="mobile" placeholder="Mobile Number" value="<?php echo $dbmobile; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="text" id="institute" name="institute" placeholder="institute"  value="<?php echo $institute; ?>" required>
								</div>
							 </div>

							 <!-- <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="text" id="rank" name="rank" placeholder="Rank"  value="<?php echo $rank; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="text" id="displine" name="displine" placeholder="displine"  value="<?php echo $displine; ?>" required>
								</div>
							 </div> -->
							 
							 <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="email" id="email" placeholder="Email" name="email" readonly value="<?php echo $_SESSION['username']; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6"></div>
							 <div class="col-md-6 mt-5">
							 	<div class="form-group text-center mb-3">
									<input name="submit" class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Update Profile">
								</div>
							 </div>
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


	</div>

	<script src="js/custom-file-input.js"></script>
	<?php require_once('footer.php'); ?>