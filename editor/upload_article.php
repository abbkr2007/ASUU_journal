<?php require_once('header.php'); 
// include for php mailer 
include('../login/include/db2.php');
// include('../login/phpmailer/class.phpmailer.php');
$email = $_SESSION['username'];
$fname = $_SESSION['fname'];
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
.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
	position: relative;
	width: 100%;
	padding-right: 13px;
	padding-left: 15px;
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
									      <?php
											if(isset($_POST['submit'])){
												$type = $_POST['type'];
												$title = $_POST['title'];
												$authors = $_POST['authors'];
												$year = $_POST['vy'];
												$volume = $_POST['volume'];
      											$month1 = $_POST['month1'];
      											$month2 = $_POST['month2'];
      											$nos1 = $_POST['nos1'];
      											$nos2 = $_POST['nos2'];
												$date = date('Y-m-d H:i:s');
												// files 
												$files = $_FILES['Upload'];
												$file_name = $_FILES['Upload']['name'];
												$file_size = $_FILES['Upload']['size'];
												$tmp_name = $_FILES['Upload']['tmp_name'];
												$photo_ex = pathinfo($file_name,PATHINFO_EXTENSION);
									   
												if($type == "alif"){
													$error = "Please Select a Journal";
												}
												else if($year == "alif"){
													$error = "Year is Required!";
												}
												else if($volume == "alif"){
													$error = "Volume is Required!";
												}
												else if($month1 == "alif"){
													$error ="Month is Required!";
												}
												else if($month2 == "alif"){
													$error = "Month is Required!";
												}
												else if($nos1 == "alif"){
													$error = "Nos is Required!";
												}
												else if($nos2 == "alif"){
													$error = "Nos is Required!";
												}
												else if(empty($file_name)){
												    $error = "Please Attach a PDF file!";
												}
												else if($photo_ex != 'PDF' AND $photo_ex != 'pdf'){
													$error = "Extension not allowed, please Attach a PDF file.";
												}
												else if($file_size > 99999999992){
												    $error = "Sorry, your file is too large..max size 3MB";
												}
												else{
													$rand_number = rand(999,9999);
									   
												    $newName = $authors."-".$file_name.$rand_number.".".$photo_ex;
												    $upload = move_uploaded_file($tmp_name,'uploaded_articles/'.$newName);

													if($upload == true){
															
														$alif = $pdo->prepare("INSERT INTO uploaded_articles(
															type,
															tittle,
															vy,
															volume,
															nm,
															nm2,
															nos1,
															nos2,
															authors,
															url,
															submit_date,
															submited_by
														) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
														$alif->execute(array(
															$type,
															$title,
															$year,
															$volume,
															$month1,
															$month2,
															$nos1,
															$nos1,
															$authors,
															$newName,
															$date,
															$email

														));
														$lastID = $DB->lastInsertId();
          
														$message = '<html><head>
															   <title>ASUU - Journal</title>
															   </head>
															   <body>';
														$message .= '<h1>Hello ' . $fname . '!</h1>';
														$message .= '<p> Thank you ' .  '</p>';
														$link = 'https://ejournals.asuu.org.ng/login/';
														$message .="<a href = ''></a>"; 
														$message .= '<p> Here are Submit Article credencials
														
																 <ul> 
																 <li>Click the Link to Login : ' . $link . ' </li>
																 <li>'.$title.' Article Succesfully Submited </li>
														</p>';
														
														
														echo '<br>';
														
														$message .= '<p>Thank you, <br> Ejournal Academic Staff Union of Universities
														
														</p>';
														$message .= "</body></html>";
														
												    
														// php mailer code starts
												// 		$mail = new PHPMailer(true);
												// 		$mail->IsSMTP(); // telling the class to use SMTP
												    
												// 		$mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
												// 		$mail->SMTPAuth = true;                  // enable SMTP authentication
												// 		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
												// 		$mail->Host = "smtppro.zoho.com";      // sets  s the SMTP server
												// 		$mail->Port = 465;                   // set the SMTP port for the GMAIL server
												    
												// 		$mail->Username = 'noreply@asuu.org.ng';
												// 		$mail->Password = 'all_Binder@#keh99akpo';
												    
												// 		$mail->SetFrom('noreply@asuu.org.ng', 'Academic Staff of Universities');
												// 		$mail->AddAddress($email);
												    
												// 		$mail->Subject = trim("ASUU E-Journal Submit Article");
												// 		$mail->MsgHTML($message);
												    
												// 		try {
												// 		  $mail->send();
												// 		  $msg2 = "Successfully Submit Article";
												// 		  $msgType = "success";
												// 		} catch (Exception $ex) {
												// 		  $msg = $ex->getMessage();
												// 		  $msgType = "warning";
												// 		}

														$success = "Successfully Recorded";
													}
													else{
														$error = "Format not supported, please choose PDF";
													}

											    }
												
											 }
											



											 if(isset($success)){
												echo '<div class="alert alert-success"><strong>Article: </strong> '. $success .'</div>';
											}
											if(isset($error)){
												echo '<div class="alert alert-danger"><strong>Article: </strong> '. $error .'</div>';
											}
										
										?>  

										<h4>Upload Article</h4>
									</div>
                                   
							<div>   
								<form action="#" method="POST" enctype="multipart/form-data">
									<div class="form-group">
										<select class="form-select custom-select" aria-label="Default select example" name="type" required>
											<option value="alif" selected>----Type of Journal----</option>
											<option value="Journal of Humanities">Journal of Humanities</option>
											<option value="Journal Social Sciences">Journal of Social Sciences</option>
											<option value="Journal of Science">Journal of Science</option>
											<option value="Magazines">Magazines</option>
										</select>
									</div>
									<div class="form-group">
										<input class="form-control" type="text" id="lname" name="title" placeholder="Article Title " required>
									</div>
									<div class="row">
											<div class="col-md-6">
												<div class="form-group">

													<select class="form-select custom-select" aria-label="Default select example" name="vy" required>
														<option value="alif" selected>--Select Year--</option>
														<option value="2009">2009</option>
														<option value="2010">2010</option>
														<option value="2011">2011</option>
														<option value="2012">2012</option>
														<option value="2013">2013</option>
														<option value="2014">2014</option>
														<option value="2015">2015</option>
														<option value="2016">2016</option>
														<option value="2017">2017</option>
														<option value="2018">2018</option>
														<option value="2019">2019</option>
														<option value="2020">2020</option>
														<option value="2021">2021</option>
														<option value="2022">2022</option>
														<option value="2023">2023</option>
														<option value="2024">2024</option>
														<option value="2025">2025</option>
													</select>
													<!-- <input class="form-control" type="text" id="lname" name="vy" placeholder="Enter Volume i.e Volume 6(2019)" required> -->
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">

													<select class="form-select custom-select" aria-label="Default select example" name="volume" required>
														<option value="alif" selected>--Select Volume--</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
														<option value="14">14</option>
														<option value="15">15</option>
														<option value="16">16</option>
														<option value="17">17</option>
														<option value="18">18</option>
														<option value="19">19</option>
														<option value="20">20</option>
														
													</select>
													<!-- <input class="form-control" type="text" id="lname" name="vy" placeholder="Enter Volume i.e Volume 6(2019)" required> -->
												</div>
											</div>
									</div>
									
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
											
												<select class="form-select custom-select" aria-label="Default select example" name="month1" required>
													<option value="alif" selected>Month</option>
													<option value="January">January</option>
													<option value="February">February</option>
													<option value="March">March</option>
													<option value="April">April</option>
													<option value="May">May</option>
													<option value="June">June</option>
													<option value="July">July</option>
													<option value="August">August</option>
													<option value="September">September</option>
													<option value="October">October</option>
													<option value="November">November</option>
													<option value="December">December</option>
												</select>

												<!-- <input class="form-control" type="text" id="lname" name="nm" placeholder="Enter Nos & Month i.e Nos 1 & 2 June & Dec" required> -->
											</div>
											
										</div>
										<div class="col-md-3">
											<div class="form-group">
											
												<select class="form-select custom-select" aria-label="Default select example" name="month2" required>
													<option value="alif" selected>Month</option>
													<option value="January">January</option>
													<option value="February">February</option>
													<option value="March">March</option>
													<option value="April">April</option>
													<option value="May">May</option>
													<option value="June">June</option>
													<option value="July">July</option>
													<option value="August">August</option>
													<option value="September">September</option>
													<option value="October">October</option>
													<option value="November">November</option>
													<option value="December">December</option>
												</select>

												<!-- <input class="form-control" type="text" id="lname" name="nm" placeholder="Enter Nos & Month i.e Nos 1 & 2 June & Dec" required> -->
											</div>
											
										</div>

										<div class="col-md-3">
											<div class="form-group">
											
												<select class="form-select custom-select" aria-label="Default select example" name="nos1" required>
													<option value="alif" selected>Nos</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
												</select>

												<!-- <input class="form-control" type="text" id="lname" name="nm" placeholder="Enter Nos & Month i.e Nos 1 & 2 June & Dec" required> -->
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
											
												<select class="form-select custom-select" aria-label="Default select example" name="nos2" required>
													<option value="alif" selected>Nos</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
												</select>

												<!-- <input class="form-control" type="text" id="lname" name="nm" placeholder="Enter Nos & Month i.e Nos 1 & 2 June & Dec" required> -->
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<input class="form-control" type="text" id="lname" name="authors" placeholder="Author's name " required>
									</div>
									<div class="form-group">
										<!-- <input class="form-control" type="file" id="Upload" name="Upload" required> -->
				    						
										<div class="box">
											<input type="file" name="Upload" id="file-2" class="inputfile inputfile-2 d-none" data-multiple-caption="{count} files selected" multiple />
											<label for="file-2" class="form-control"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a PDF file&hellip;</span></label>
										</div>


									</div>
									
                                  			<div class="form-group text-center mb-3">
									    <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="submit" value="Submit Article">
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