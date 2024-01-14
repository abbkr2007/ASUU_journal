<?php 
require_once('config.php');
require_once('header.php');

$user_email = $_SESSION['username'];
	function postCount($cetagory){
		global $pdo;
		$alif = $pdo->prepare("SELECT  vy,volume  FROM uploaded_articles WHERE type=?");
		$alif->execute(array($cetagory));
		$dbresult = $alif->fetchAll(PDO::FETCH_ASSOC);
		$h_count = array_unique($dbresult, SORT_REGULAR);
		$result = count($h_count);
		return $result;
	}

	$stm= $pdo->prepare("SELECT * FROM manuscripts_docs WHERE email=?");
	$stm->execute(array($user_email));
	$allCount =$stm->rowCount();

	$type1 = "Journal of Humanities";
	$type2 = "Journal Social Sciences";
	$type3 = "Journal of Science";
	$type4 = "Magazines";

?>
<style>
	.site-footer {
		margin-top: 43px;
	}
</style>
	<link href="../editor/css/teb_menu.css" rel="stylesheet"/>
		<main class="main_content">
		
			<div class="container">

			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div _ngcontent-nqw-c5="" class="search-bar-container fill-background not-homepage">
						<xpl-search-bar-migr _ngcontent-nqw-c5="" _nghost-nqw-c11="">
							<div _ngcontent-nqw-c11="" class="search-bar">

		

							</div>
						</xpl-search-bar-migr>
					</div>
				</div>
			</div>



				<div class="row justify-content-center">
					<div class="col-lg-11">
						<div class="row justify-content-center">
						<div class="col-lg-3 col-md-6 bg_color_1 mb-lg-0 mb-4">
								<h4 class="browse_title">History</h4>
								<div class="article_quick_links">
									<ul class="list-group">
										<li class="list-group-item" style="font-weight: 700; color: #8cc63f">Assign Manuscripts</li>
										<li class="list-group-item">
											<a id="al_tab1" href="#">Journal of Humanities
												<span class="pull-right badge"><?php echo postCount($type1); ?>
													<i class="fas fa-chevron-down  " id="ch1"></i>	
												</span>
											</a>
											<ul class="ALDropdown_menu" id="alDm1">
											<?php 
												$alif = $pdo->prepare("SELECT vy,volume FROM uploaded_articles WHERE type=?");
												$alif->execute(array($type1));
												$dbresult = $alif->fetchAll(PDO::FETCH_ASSOC);
												$unick = array_unique($dbresult, SORT_REGULAR);
												foreach ($unick as $row) :
											?>
												<li>
													<a href="journal-view.php?type=1&volume=<?php echo $row['volume']; ?>&vy=<?php echo $row['vy']; ?>">Volume: <?php echo $row['volume']; ?> (<?php echo $row['vy']; ?>)</a>
												</li>
											<?php endforeach; ?>
											</ul>
										</li>

										<li class="list-group-item">
											<a id="al_tab2" href="#">Journal Social Sciences
												<span class="pull-right badge"><?php echo postCount("Journal Social Sciences"); ?>
													<i class="fas fa-chevron-down  " id="ch2"></i>
												</span>
											</a>
											<ul class="ALDropdown_menu" id="alDm2">
											<?php 
												$alif = $pdo->prepare("SELECT vy,volume  FROM uploaded_articles WHERE type=?");
												$alif->execute(array("Journal Social Sciences"));
												$result = $alif->fetchAll(PDO::FETCH_ASSOC);
												$unick = array_unique($result, SORT_REGULAR);
												foreach ($unick as $row) :
											?>
												<li>
													<a href="journal-view.php?type=2&volume=<?php echo $row['volume']; ?>&vy=<?php echo $row['vy']; ?>">Volume: <?php echo $row['volume']; ?> (<?php echo $row['vy']; ?>)</a>
												</li>
											<?php endforeach; ?>
											</ul>
										</li>

										<li class="list-group-item">
											<a id="al_tab3" href="#">Journal of Science 
												<span class="pull-right badge"><?php echo postCount("Journal of Science"); ?>
													<i class="fas fa-chevron-down  " id="ch3"></i>
												</span>
											</a>
											<ul class="ALDropdown_menu" id="alDm3">
											<?php 
												$alif = $pdo->prepare("SELECT vy,volume FROM uploaded_articles WHERE type=?");
												$alif->execute(array("Journal of Science"));
												$result = $alif->fetchAll(PDO::FETCH_ASSOC);
												$unick = array_unique($result, SORT_REGULAR);
												foreach ($unick as $row) :
											?>
												<li>
													<a href="journal-view.php?type=3&volume=<?php echo $row['volume']; ?>&vy=<?php echo $row['vy']; ?>">Volume: <?php echo $row['volume']; ?> (<?php echo $row['vy']; ?>)</a>
												</li>
											<?php endforeach; ?>
											</ul>
										</li>

										<li class="list-group-item">
											<a id="al_tab4" href="#">Magazines 
												<span class="pull-right badge"><?php echo postCount("Magazines"); ?>
													<i class="fas fa-chevron-down  " id="ch4"></i>
												</span>
											</a>
											<ul class="ALDropdown_menu" id="alDm4">
											<?php 
												$alif = $pdo->prepare("SELECT vy,volume FROM uploaded_articles WHERE type=?");
												$alif->execute(array("Magazines"));
												$dbresult = $alif->fetchAll(PDO::FETCH_ASSOC);
												$unick = array_unique($dbresult, SORT_REGULAR);
												foreach ($unick as $row) :
											?>
												<li>
													<a href="journal-view.php?type=4&volume=<?php echo $row['volume']; ?>&vy=<?php echo $row['vy']; ?>">Volume: <?php echo $row['volume']; ?> (<?php echo $row['vy']; ?>)</a>
												</li>
											<?php endforeach; ?>
											</ul>
										</li>
									</ul>
								</div>


			


							</div>

							<!-- right section -->
							<div class="col-lg-9">
								<div class="right_section">
									<div class="row">
										<div class="col-md-4  ">
											
										</div>
										<div class="col-md-4  ">
											
										</div>
										<div class="col-md-4  ">
										
										</div>
									</div>

								</div>
							</div>


						</div>
					</div>
					

					

				</div>
			</div>
		</main>


	</div>

<?php require_once('footer.php'); ?>
<script src="../editor/js/Al_script.js"></script>