<?php require_once('header.php'); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../login/include/db2.php');
include('../login/phpmailer/class.phpmailer.php');
if(isset($_POST['submit'])){

     $f_name = $_POST['f_name'];
     $l_name = $_POST['l_name'];
     $m_name = $_POST['m_name'];
     $mobile = $_POST['mobile'];
     $institute = $_POST['institute'];
     $rank = $_POST['rank'];
     $displine = $_POST['displine'];

     if(empty($f_name)){
          $msg = 'First Name is Empty';
     }
    else if(empty($m_name)){
          $msg = 'Middle Name is Empty';
     }
	else if(empty($l_name)){
          $msg = 'Last Name is Empty';
     }
	else if(empty($institute)){
		$msg = 'institute is Empty';
	}
		else if(empty($rank)){
		$msg = 'Rank is Empty';
	}
		else if(empty($displine)){
		$msg = 'Displine is Empty';
	}
		else if(empty($mobile)){
		$msg = 'Mobile is Empty';
	}
     else{
          $email = $_SESSION['username'];
          $fname = $_SESSION['fname'];

          $stm = $pdo->prepare("UPDATE ejournal_users SET fname=?, lname=?, mName=?, institution=?, rank=?, displine=?, mobile=? WHERE email=?");
		$stm->execute(array($f_name,$l_name,$m_name,$institute, $rank, $displine, $mobile,$email));

         
          $lastID = $DB->lastInsertId();
          
                $message = '<html><head>
                        <title>ASUU - Journal</title>
                        </head>
                        <body>';
                $message .= '<h1>Hello ' . $fname . '!</h1>';
                $message .= '<p> Thank you for Get in Touch Academic Staff Union of Universities E-journal, we are happy to have you here' .  '</p>';
                $link = 'https://ejournals.asuu.org.ng/login/';
                $message .="<a href = ''></a>"; 
                $message .= '<p> Here are Profile Update credencials
                
                           <ul> 
                           <li>Click the Link to Login : ' . $link . ' </li>
                           <li>Your Profile Update Succesfully done </li>
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
          
                $mail->Username = 'abubakar@asuu.org.ng';
                $mail->Password = 'all_Binder@#keh99akpo';
          
                $mail->SetFrom('abubakar@asuu.org.ng', 'Academic Staff of Universities');
                $mail->AddAddress($email);
          
                $mail->Subject = trim("ASUU E-Journal Change Profile");
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
               $m_name =  $data_array[0]['mName'];
               $last_name =  $data_array[0]['lname'];
               $institute =  $data_array[0]['institution'];
               $rank =  $data_array[0]['rank'];
               $displine =  $data_array[0]['displine'];
               $dbmobile =  $data_array[0]['mobile'];
			
			
			?>

			 			<div class="row">
							 <div class="col-md-6">
								<div class="form-group">
									<input class="form-control" type="text" id="f_name" name="f_name" placeholder="First Name"  value="<?php echo $first_name; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
								<div class="form-group">
									<input class="form-control" type="text" id="m_name" name="m_name" placeholder="Middle Name"  value="<?php echo $m_name; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
								<div class="form-group">
									<input class="form-control" type="text" id="l_name" name="l_name" placeholder="Last Name"  value="<?php echo $last_name; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="text" id="institute" name="institute" placeholder="institute"  value="<?php echo $institute; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="text" id="rank" name="rank" placeholder="Rank"  value="<?php echo $rank; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="text" id="displine" name="displine" placeholder="displine"  value="<?php echo $displine; ?>" required>
								</div>
							 </div>
							 <div class="col-md-6">
							 	<div class="form-group">
									<input class="form-control" type="text" id="mobile" name="mobile" placeholder="Mobile Number" value="<?php echo $dbmobile; ?>" required>
								</div>
							 </div>
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