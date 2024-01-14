<?php require_once('header.php'); ?>
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
	.right_section {
		background: #eee;
		padding: 30px 70px;
		border-radius: 6px;
	}

	.form-group {
		margin-bottom: 1.6rem;
	}

	.site-footer {
		margin-top: 42px;
	}

	.tittle {
		border-bottom: 2px solid #87201b;
		border-left: 20px solid #87201b;
		border-top: 0px solid #DE3B04;
		border-right: 0px solid #DE3B04;
		padding-left: 20px;
		padding: 5px 5px;
		max-width: 100%;
		padding-bottom: 5px;
		color: black;
		font-size: 16pt;
		font-family: "Verdana";
		padding: 10px;
	}

	label {
		padding: 5px 5px;
		max-width: 100%;
		padding-bottom: 5px;
		color: #ffff;
		font-size: 12pt;
		font-family: "Verdana";
		background-color: #87201b;
		border-top: 2px solid #DE3B04;
		padding: 2px;

	}

	.required:after {
		content: '*';
		color: red;
		padding-right: 5px;
	}

	.inputfile+label {
		font-size: 16px;
		font-weight: 400;
		white-space: nowrap;
		cursor: pointer;
		/* padding-bottom: 40px; */
		/* line-height: 41px; */
		padding: 5px 16px;
		max-width: 100%;
		padding-bottom: 5px;
	}

	.required:before {
		content: "*";
		font-weight: bold;
		color: red;
	}

	.inputfile+label svg {
		width: 2em;
		height: 2em;
		vertical-align: middle;
		fill: currentColor;
		margin-top: -0.25em;
		margin-right: 0.25em;
	}

	.inputfile-2+label {
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

	.input-group-text {
		background-color: #fff;
		border: 1px solid #e60000;
	}

	.al_required {
		color: red;
		font-size: 30px;
		position: absolute;
		right: 42px;
		top: 1px;
	}

	.input-group {
		margin-bottom: 1.6rem;
	}

	select {
		/* for Firefox */
		-moz-appearance: none;
		/* for Chrome */
		-webkit-appearance: none;
	}

	/* For IE10 */
	select::-ms-expand {
		display: none;
	}
</style>

<script>
	(function(e, t, n) {
		var r = e.querySelectorAll("html")[0];
		r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
	})(document, window, 0);
</script>

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


								if (isset($_SESSION["message"])) {
									$error = $_SESSION["message"];
									echo '<div class="alert alert-success">' . $error . '</div>';
									unset($_SESSION["message"]);
								} else {
									if (isset($_SESSION["message2"])) {

										echo '<div class="alert alert-danger" role="alert">
                             ' . $_SESSION["message2"] . '
                            </div>';
										unset($_SESSION["message2"]);
									}
								}

								?>
								<h5 class="tittle">Manuscript Submission</h5>

							</div>
							<div>
								<form action="upload.php" method="POST" enctype="multipart/form-data">

									<div class="input-group">
										<select class="form-select custom-select" aria-label="Default select example" name="ty" required>
											<option selected>----Journal Type----</option>
											<option value="Journal of Humanities">Journal of Humanities (AJH)</option>
											<option value="Journal Social Sciences">Journal of Social Sciences(AJSS)</option>
											<option value="Journal of Science">ASUU Journal of Science (AJS)</option>
										</select>
										<!--<div class="al_required">*</div>-->
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="fa fa-book" aria-hidden="true"></i></span>
										</div>
									</div>
									<div class="input-group">
										<input class="form-control" type="text" id="lname" name="title" placeholder="Article Title " required>
										<div class="al_required">*</div>
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="fa fa-text-height" aria-hidden="true"></i></span>
										</div>

									</div>
									<div class="input-group">
										<input class="form-control" type="text" id="area" name="displine" placeholder="Displine : i.e Computer Science " required>
										<div class="al_required">*</div>
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="fa fa-book" aria-hidden="true"></i></span>
										</div>

									</div>
									<h5 style=" display: flex; justify-content: center">
										<label for="">Suggest a Reviewer</label>
									</h5>

									</h5>
									<br />
									<label>Reviewer 1</label>
									<br>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<select class="form-select custom-select" aria-label="Default select example" name="r1-tittle" required>
													<option>Tittle</option>
													<option>Prof.</option>
													<option>Dr.</option>

												</select>
												<!-- <input class="form-control" type="text" id="lname" name="vy" placeholder="Enter Volume i.e Volume 6(2019)" required> -->
											</div>
										</div>

										<div class="col-md-9">
											<div class="input-group">
												<input class="form-control" type="text" id="area" name="r1-fname" placeholder=" Full Name i.e Abubakar Ibrahim" required>
												<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
											</div>

										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input class="form-control" type="email" id="area" name="r1-email" placeholder=" Email Address" required>
												<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input class="form-control" type="number" id="area" name="r1-phone" placeholder=" Mobile Number" required>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="input-group">
										<textarea class="form-control" name="r1-address" placeholder=" Address: i.e University, Faculty, Department"></textarea required>
										<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
												</div>
									</div>
									<div class="input-group">
										<textarea class="form-control" name="r1-reason" placeholder="Reason"></textarea>
										<div class="al_required">*</div>
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="fa fa-tasks" aria-hidden="true"></i></span>
										</div>
									</div>
									<br>
									<label>Reviewer 2</label>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<select class="form-select custom-select" aria-label="Default select example" name="r2-tittle" required>
													<option>Tittle</option>
													<option>Prof.</option>
													<option>Dr.</option>
												</select>
												<!-- <input class="form-control" type="text" id="lname" name="vy" placeholder="Enter Volume i.e Volume 6(2019)" required> -->
											</div>
										</div>

										<div class="col-md-9">
											<div class="input-group">
												<input class="form-control" type="text" id="area" name="r2-fname" placeholder=" Full Name i.e Abubakar Ibrahim" required>
												<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input class="form-control" type="email" id="area" name="r2-email" placeholder=" Email Address" required>
												<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input class="form-control" type="number" id="area" name="r2-phone" placeholder=" Mobile Number" required>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="input-group">
										<textarea class="form-control" name="r2-address" placeholder=" Address: i.e University, Faculty, Department"></textarea required>
											<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
									</div>
									<div class="input-group">
										<textarea class="form-control" name="r2-reason" placeholder="Reason"></textarea>
										<div class="al_required">*</div>
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
										</div>
									</div>
									<br>
									<label>Reviewer 3</label>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<select class="form-select custom-select" aria-label="Default select example" name="r3-tittle" required>
													<option>Tittle</option>
													<option>Prof.</option>
													<option>Dr.</option>

												</select>
												<!-- <input class="form-control" type="text" id="lname" name="vy" placeholder="Enter Volume i.e Volume 6(2019)" required> -->
											</div>
										</div>

										<div class="col-md-9">
											<div class="input-group">
												<input class="form-control" type="text" id="area" name="r3-fname" placeholder=" Full Name i.e Abubakar Ibrahim" required>
												<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input class="form-control" type="email" id="area" name="r3-email" placeholder=" Email Address" required>
												<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input class="form-control" type="number" id="area" name="r3-phone" placeholder=" Mobile Number" required>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="input-group">
										<textarea class="form-control" name="r3-address" placeholder=" Address: i.e University, Faculty, Department"></textarea required>
											<div class="al_required">*</div>
												<div class="input-group-append custom">
													<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
												</div>
									</div>
									<div class="input-group">
										<textarea class="form-control" name="r3-reason" placeholder="Reason"></textarea>
										<div class="al_required">*</div>
										<div class="input-group-append custom">
											<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
										</div>
									</div>
									<div class="form-group">
										<!-- <input class="form-control" type="file" id="Upload" name="Upload" required> -->

										<div class="box">
											<input type="file" name="Upload" id="file-2" class="inputfile inputfile-2 d-none" data-multiple-caption="{count} files selected" multiple />
											<label for="file-2" class="form-control"><svg xmlns="#" width="20" height="17" viewBox="0 0 20 17">
													<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
												</svg> <span>Choose a Word Doc file&hellip;</span></label>

										</div>





									</div>

									<div class="form-group text-center mb-3">
										<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Submit Manuscript">
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