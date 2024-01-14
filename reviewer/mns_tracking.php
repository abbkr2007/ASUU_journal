<?php 
require_once('header.php');
require_once('config.php');
// session_start();
// if (!isset($_SESSION['username'])){ 
//   header("Location: /login");
// }
$user_email = $_SESSION['username'];
?>

<style>
	.status_sty{
		padding: 0 15px;
		border-radius: 50px;
		font-size: 15px;
		color: #fff;
		text-transform: capitalize;
	}
	.submitted {
		background: #ffa700;
	}
	.under_review{
		background: purple;
	}
	.minor_correction{
		background : blue;
	}
	.major_correction{
		background : brown;
	}
	.accepted{
		background : green;
	}
	.rejected{
		background : red;
	}

</style>




		<main class="main_content">
			<div class="container">


			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div _ngcontent-nqw-c5="" class="search-bar-container fill-background not-homepage">
						<xpl-search-bar-migr _ngcontent-nqw-c5="" _nghost-nqw-c11="">
							<div _ngcontent-nqw-c11="" class="search-bar">

								<form _ngcontent-nqw-c11="" class="search-bar-wrapper ng-untouched ng-pristine ng-valid" novalidate="">
									
									<div _ngcontent-nqw-c11="" class="drop-down">
										<label _ngcontent-nqw-c11="">
											<select _ngcontent-nqw-c11="" class="custom-select" aria-label="content type dropdown"><!---->
												<option _ngcontent-nqw-c11="">All</option>
												<option _ngcontent-nqw-c11="">Books</option>
												<option _ngcontent-nqw-c11="">Conferences</option>
												<option _ngcontent-nqw-c11="">Courses</option>
												<option _ngcontent-nqw-c11="">Journals &amp; Magazines</option>
												<option _ngcontent-nqw-c11="">Standards</option>
												<option _ngcontent-nqw-c11="">Authors</option>
												<option _ngcontent-nqw-c11="">Citations</option>
											</select>
										</label>
									</div>

									<div _ngcontent-nqw-c11="" class="search-field all">
										<!---->
										<div _ngcontent-nqw-c11="" class="search-field-container">
											<!---->
											<div _ngcontent-nqw-c11="" class="global-search-bar">
												<xpl-typeahead-migr _ngcontent-nqw-c11="" minchars="3" name="search-term" placeholder="" ulclass="search-within-results ui-autocomplete ui-front ui-menu ui-widget ui-widget-content ui-corner-all" _nghost-nqw-c20="">
												<div _ngcontent-nqw-c20="" class="Typeahead">

												<input _ngcontent-nqw-c20="" aria-label="Enter search text" autocomplete="off" class="Typeahead-input ng-pristine ng-valid ng-touched form-control" type="text" placeholder="Search Here...">
												<!---->
											</div>
											</xpl-typeahead-migr></div>
											<!---->
										</div>
									</div>
									
									<div _ngcontent-nqw-c11="" class="search-icon">
										<button _ngcontent-nqw-c11="" class="fa fa-search form-control" aria-label="Search" class="fa fa-search" type="submit"></button>
									</div>
								</form>

							</div>
						</xpl-search-bar-migr>
					</div>
				</div>
			</div>



				<div class="row justify-content-center">
					<div class="col-lg-10">
						<div class="row">

						<?php  
							$limit = 4;
							if(isset($_REQUEST['page'])){
								$page = $_REQUEST['page'];
							}
							else{
								$page = 1;
							}
							$offset = ($page-1)*$limit;


							$stm= $pdo->prepare("SELECT * FROM manuscripts_docs WHERE email=? ORDER BY m_id DESC LIMIT $offset, $limit");
							$stm->execute(array($user_email));
							$postCount =$stm->rowCount();
							if($postCount == 0){
								echo "<h3 style='font-size:30px;color:#f00;'>"."There are No Any post!";
							}
							else{
								$result = $stm->fetchAll(PDO::FETCH_ASSOC);
								foreach ($result as $row):
						?>

							<div class="col-12">
								<div class="list_wrapper">
									<div class="list_title">
										<h4><?php echo $row['article_tittle'];?></h4>
									</div>

									<div class="listed_tags">
										<ul class="list-group list-group-horizontal flex-wrap">
											<li class="list-group-item">
											    <?php echo $row['fname'];?>
											</li>
										</ul>
									</div>

									<!-- yearly info -->
									<div class="other_info my-1">
										<ul class="list-group list-group-horizontal flex-wrap">
											<li class="list-group-item">Date: <?php echo $row['date_s'];?></li>
											<li class="list-group-item">Type:<?php echo $row['category'];?></li>
											<li class="list-group-item border-0">Publisher:Academic Staff Union of Universities (ASUU)</li>
										<li class="list-group-item border-0">
										    
										    
										    
										   </li>
										
										</ul>
									</div>


									<div class="pdf_section">
										<div class="abstract_wrap" data-toggle="modal" data-target="#myModal" type="button">
											<i class="fas fa-caret-right"></i>  <span>Update Manuscript</span>
										</div>

										<div class="pdf_wrap">
											<a href="<?php echo $row['f_url'];?>" download="<?php echo $row['f_url']; ?>"> <i class="fas fa-download    "></i> (Download)</a>
										</div> &nbsp;&nbsp;&nbsp;&nbsp;
										<div class="status">
										<strong>Status:&nbsp;</strong> <?php 
											$status = $row['status'];
											if($status == 'Submited'){
												echo "<span class='status_sty submitted'>".$status."</span>";
											}
											else if($status == 'under review'){
												echo "<span class='status_sty under_review'>".$status."</span>";
											}
											else if($status == 'minor corrections'){
												echo "<span class='status_sty minor_correction'>".$status."</span>";
											}
											else if($status == 'major corrections'){
												echo "<span class='status_sty major_correction'>".$status."</span>";
											}
											else if($status == 'accepted'){
												echo "<span class='status_sty accepted'>".$status."</span>";
											}
											else if($status == "rejected"){
												echo "<span class='status_sty rejected'>".$status."</span>";
											}
										
										?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ; 
						
						}?>
						</div>



	<!-- ////// php pagination ///////-->

	<?php 
	$stm= $pdo->prepare("SELECT * FROM manuscripts_docs WHERE email=? ORDER BY m_id DESC");
	$stm->execute(array($user_email));
	$Ubooks =$stm->rowCount();
	// $result = $stm->fetchAll(PDO::FETCH_ASSOC);
	


	if($Ubooks > 0)
		$total_record = $Ubooks;
		$total_page = ceil($total_record/ $limit);

		echo '<ul class="pagination justify-content-center">';	
		if ($page > 1) {
		echo ' <li class="page-item"><a class="page-link" href="mns_tracking.php?page='.($page - 1).'">Prev</a></li>';
		}			
		for ($i=1; $i<=$total_page; $i++) { 
			if($i == $page){
			$active = "active";
			}
			else{
				$active = "";
			}
			echo '<li class="page-item"><a class="page-link'
			." ".$active.'" href="mns_tracking.php?page='.$i.'">'.$i.'</a></li>';
		}
		if($total_page > $page){
		echo '<li class="page-item"><a class="page-link" href="mns_tracking.php?page='.($page + 1).'">Next</a></li>';
		}
		echo '</ul>';
	?>
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
						<iframe src="/manuscripts_docs/Abstract.docx" style="width:100%; height:600px;" frameborder="0"></iframe>					</div>


				</div>
			</div>
		</div>

	</div>
<?php require_once('footer.php'); ?>