<?php 
session_start();
$db = mysqli_connect("localhost","u805855018_asuu_db","Minder_Binder12","u805855018_asuu_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if(isset($_POST['login']))
    {
        $email=mysqli_real_escape_string($db, $_POST['username']);
        $password=mysqli_real_escape_string($db, $_POST['password']);
        $passwordmd5 = md5($password);
        $login="SELECT * FROM ejournal_users WHERE  email= '$email' AND password = '$passwordmd5' ";
        $run_login = mysqli_query($db, $login) or die(mysqli_error($db));
        $count = mysqli_num_rows($run_login);
        $results = mysqli_fetch_assoc($run_login);
        $userRole=$results['user_role'];
        $redirect=$results['redirect'];
        $fname=$results['fname'];
        $lname = $results['onames'];
        
        if($count == 1)
         {
        $_SESSION['username']=$email;
        $_SESSION['role']=$userRole;
        $_SESSION['fname']=$fname;
        $_SESSION ['onames'] = $lname;
        header("Location:$redirect");
        }else
        {
           $message = "Invalid Login Credentials";
          
        }
  
    }
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
	<style>

		.u_ab .li_ab a {
			color: #ED2F59;
			/* font-size: 15px; */
			transition : .4s;
		}
		.u_ab .li_ab a:hover{
			opacity: .8;
		}
		.u_ab .li_ab a i {
			font-size: 25px;
			/* line-height: 24px; */
		}
	</style>
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="vendors/images/login-img.png" alt="login" class="login-img">
			<h2 class="text-center mb-10">E-Journal Login</h2>
			
			  <?php
                    if(isset($message)){
                        $error = $message;
                        echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $error . '</div>';
                      //  unset ($_SESSION["message"]);
                    }else{

					}
                ?>  
			
				
		    <form action="#" method="post">
				<div class="input-group custom input-group-lg">
					<input type="text" name="username" class="form-control" placeholder="Username">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<input type="password" name = "password" class="form-control" placeholder="**********">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group">
						<input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="login" value="Sign In">
						
						</div>
					</div>
                   
					<div class="col-sm-6 text-right pt-2">
						
			</form>			
					<h7><a style="color:#ED2F59; margin-left: -80px;"href="reg.php">Register |</a> <a style="color:#ED2F59; margin-right: -10px;" href="reset-password.php">Reset Password</a>	</h7>
					</div>
					
					<div class="col-md-12">
						<div class="text-center">
							<ul class="u_ab">
								<li class="li_ab">
								    	
								    		<br />
									<a class="a_ab" href="https://ejournals.asuu.org.ng/">
										<i class="fa fa-home i_ab" aria-hidden="true"></i>
										<strong>Go to Home</strong>
									</a>
								
								
								</li>
							</ul>
						<div>
					</div>
					
					

						<div class="center"></div>
					</div>
				</div>
				
			</form>
		</div>
	</div>

</body>
</html>