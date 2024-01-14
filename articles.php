<?php require_once('header.php'); ?>
<style>
	.site-footer {
	margin-top: 290px;
}
</style>
		<main class="main_content">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-10">
						<div class="row">
							<div class="col-12">
								<div class="list_wrapper">
								    <br /> 
									<div class="list_title">
										<h4></h4>
									</div>

									<div class="listed_tags">
										<ul class="list-group list-group-horizontal flex-wrap">
										
										
											<li class="list-group-item">
											    
										<select _ngcontent-nqw-c11="" class="custom-select" aria-label="content type dropdown" id="urlSelect" onchange="window.location = jQuery('#urlSelect option:selected').val();"><!---->
													<option _ngcontent-nqw-c11=""  value="articles.php" selected>Articles</option>
													<option _ngcontent-nqw-c11=""  value="current_issues.php" >Current Issues</option>
													<option _ngcontent-nqw-c11=""  value="archives.php">Archives</option>
										
												</select>

											
										</ul>
									</div>
                                    <br />
									<!-- yearly info -->
									<div class="other_info my-1">
										<ul class="list-group list-group-horizontal flex-wrap">
											<li class="list-group-item">year: 2017</li>
											<li class="list-group-item">Article</li>
											<li class="list-group-item border-0">Publisher:Academic Staff Union of Universities (ASUU)</li> |
												<li class="list-group-item border-0">
												
											Publications :Current issue
											</li>
										</ul>
									</div>


									<div class="pdf_section">
										<div class="abstract_wrap" data-toggle="modal" data-target="#myModal" type="button">
											<i class="fas fa-caret-right"></i> <span>View articles</span>
										</div>

										<div class="pdf_wrap">
											<a href=""><img src="img/pdf_icon.png">(Download)</a>
										</div>
									</div>
								</div>
							</div>



						</div>
					</div>
					

					

				</div>
			</div>
		</main>
		<!-- The Modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">

					<button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>

					<!-- Modal body -->
					<div class="modal-body">
						<iframe src="Abstract.pdf" style="width:100%; height:600px;" frameborder="0"></iframe>					</div>


				</div>
			</div>
		</div>

	</div>
	<script>
    $(function(){
      // bind change event to select
      $('#dynamic_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>
<?php require_once('footer.php'); ?>