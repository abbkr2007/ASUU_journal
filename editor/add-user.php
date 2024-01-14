<?php
// Report all errors
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('header.php'); 
include('../login/include/db2.php');
include('../login/phpmailer/class.phpmailer.php');

if (isset($_POST['submit'])) {
    try {
        $user_role = 'reviewer';
        $full_name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordmd5 = md5($password);
        $institution = $_POST['institution'];
        $rank = $_POST['rank'];
        $displine = $_POST['displine'];
        $redirect = '/reviewer';

        $alif = $pdo->prepare("INSERT INTO ejournal_users(
               fname,
               email,
               password,
               institution,
               rank,
               displine,
               user_role,
               redirect
          ) VALUES(?,?,?,?,?,?,?,?)");

        $alif->execute(array(
            $full_name,
            $email,
            $passwordmd5,
            $institution,
            $rank,
            $displine,
            $user_role,
            $redirect
        ));

        // mail send to new user 
        $lastID = $DB->lastInsertId();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        // You may log the error or perform other error-handling tasks here
    } catch (Exception $e) {
        // Handle other types of errors
        echo "Error: " . $e->getMessage();
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
                                                  <?php if(isset($error)) :?>
                                                       <div class="alert alert-danger">
                                                            <?php echo $error; ?>
                                                       </div>
                                                  <?php endif; ?>
                                                  <?php if(isset($success)) :?>
                                                       <div class="alert alert-success">
                                                            <?php echo $success; ?>
                                                       </div>
                                                  <?php endif; ?>
										<h4>Add Reviewer </h4>
									</div>
                                   
							<div>   
						<form action="#" method="POST" >
										
                                   <div class="row">
							
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" id="name" name="name" placeholder="Type Full Name " value="<?php if(isset($full_name)){echo $full_name;} ?>">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" id="institution" name="institution" placeholder="Type Institution" value="<?php if(isset($institution)){echo $institution;} ?>">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" id="rank" name="rank" placeholder="Type rank" value="<?php if(isset($rank)){echo $rank;} ?>">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" type="text" id="displine" name="displine" placeholder="Type displine" value="<?php if(isset($displine)){echo $displine;} ?>">
									</div>
								</div>

								<div class="col-md-6">
                                             <div class="form-group">
										<input class="form-control" type="email" id="email" name="email" placeholder="Type Email" value="<?php if(isset($email)){echo $email;} ?>">
									</div>
								</div>

								<div class="col-md-6">
                                             <div class="form-group">
										<input class="form-control" type="text" id="password" name="password" placeholder="Type Password " >
									</div>
								</div>
								<div class="col-md-6"></div>
								<div class="col-md-6">
									
                                  			<div class="form-group text-center mt-5 mb-3">
									    <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name='submit' value="Add as User" >
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