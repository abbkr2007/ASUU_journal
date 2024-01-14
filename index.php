<?php
session_start();
require_once('header.php'); 
require_once('config.php');

	function postCount($cetagory){
		global $pdo;
		$alif = $pdo->prepare("SELECT  vy,volume  FROM uploaded_articles WHERE type=?");
		$alif->execute(array($cetagory));
		$dbresult = $alif->fetchAll(PDO::FETCH_ASSOC);
		$h_count = array_unique($dbresult, SORT_REGULAR);
		$result = count($h_count);
		return $result;
	}

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
     <link href="editor/css/teb_menu.css" rel="stylesheet"/>
		<main class="main_content">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8 col-md-10">
						<div _ngcontent-nqw-c5="" class="search-bar-container fill-background not-homepage">
							<xpl-search-bar-migr _ngcontent-nqw-c5="" _nghost-nqw-c11="">
								<div _ngcontent-nqw-c11="" class="search-bar">

									<form _ngcontent-nqw-c11="" class="search-bar-wrapper ng-untouched ng-pristine ng-valid" novalidate="" method="POST" action="search-result.php">
										<br />
										<div _ngcontent-nqw-c11="" class="drop-down">
											<label _ngcontent-nqw-c11="">
												<select _ngcontent-nqw-c11="" class="custom-select" aria-label="content type dropdown" name="type"><!---->
													<option _ngcontent-nqw-c11="" value="all">All</option>

													<option _ngcontent-nqw-c11="" value="Journal of Humanities">Journal of Humanities</option>

													<option _ngcontent-nqw-c11="" value="Journal Social Sciences">Journal Of Social Sciences</option>

													<option _ngcontent-nqw-c11="" value="Journal of Science">Journal of Science</option>

													<option _ngcontent-nqw-c11="" value="Magazines">Magazines</option>

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

													<input _ngcontent-nqw-c20=""  name="keyword" aria-label="Enter search text" autocomplete="off" class="Typeahead-input ng-pristine ng-valid ng-touched form-control input_border" type="text" placeholder="Search Here..."  required>
													<!---->
												</div>
												</xpl-typeahead-migr></div>
												<!---->
											</div>
										</div>
										
										<div _ngcontent-nqw-c11="" class="search-icon">
											<button _ngcontent-nqw-c11="" class="fa fa-search form-control" aria-label="Search" class="fa fa-search" type="submit" name="submit"></button>
										</div>
									</form>

								</div>
							</xpl-search-bar-migr>
						</div>
					</div>
				</div>



				<div class="row justify-content-center">
					<div class="col-lg-11">
						<div class="row justify-content-center">
						<div class="col-lg-3 col-md-6 bg_color_1 mb-lg-0 mb-4">
								<h4 class="browse_title">Browse by Category</h4>
								<div class="article_quick_links">
									<ul class="list-group">
										<li class="list-group-item" style="font-weight: 700; color: #8cc63f">List of Journals & Magazines</li>
										<li class="list-group-item">
											<a id="al_tab1" href="#">Journal of Humanities
												<span class="pull-right badge"><?php echo postCount($type1); ?>
													<i class="fas fa-chevron-down  " id="ch1"></i>	
												</span>
											</a>
											<ul class="ALDropdown_menu" id="alDm1">
											<?php 
												$alif = $pdo->prepare("SELECT volume,vy FROM uploaded_articles WHERE type=? ORDER BY vy desc");
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
											<a id="al_tab2" href="#" nowrap>Journal of Social Sciences
												<span class="pull-right badge"><?php echo postCount($type2); ?>
													<i class="fas fa-chevron-down  " id="ch2"></i>
												</span>
											</a>
											<ul class="ALDropdown_menu" id="alDm2">
											<?php 
												$type =
												$alif = $pdo->prepare("SELECT  vy,volume  FROM uploaded_articles WHERE type=? ORDER BY vy desc");
												$alif->execute(array($type2));
												$dbresult = $alif->fetchAll(PDO::FETCH_ASSOC);
												$unick = array_unique($dbresult, SORT_REGULAR);
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
												<span class="pull-right badge"><?php echo postCount($type3); ?>
													<i class="fas fa-chevron-down  " id="ch3"></i>
												</span>
											</a>
											<ul class="ALDropdown_menu" id="alDm3">
											<?php 
												$alif = $pdo->prepare("SELECT  vy,volume  FROM uploaded_articles WHERE type=? ORDER BY vy desc");
												$alif->execute(array($type3));
												$dbresult = $alif->fetchAll(PDO::FETCH_ASSOC);
												$unick = array_unique($dbresult, SORT_REGULAR);
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
												$alif = $pdo->prepare("SELECT vy,volume FROM uploaded_articles WHERE type=? ORDER BY vy desc");
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
									<div class="journals_filter">
										<h4>Journals by Category</h4>
									</div>

									<div class="row">
										<div class="col-md-4  ">
											<div class="card journel_card text-center">
											<a href="archives.php?type=3">	<img class="card-img-top mx-auto img-fluid" src="img/journal_science.png" alt="Card image"></a>
												<div class="card-body">
													
													 <a href="journal_science_board.php">Editorial Board</a> <br>
													 <a href="docs/Submission Guidelines.pdf" 
													 download="Submission Guideline"><img src="img/pdf_icon.png">Submission Guidelines</a>
										
												</div>
											</div>
										</div>
										<div class="col-md-4  ">
											<div class="card journel_card text-center">
												<a href="archives.php?type=1"><img class="card-img-top mx-auto img-fluid" src="img/journal_humanities.png"  alt="Card image"></a>
												<div class="card-body">
												<a href="journal_humanities_board.php">Editorial Board</a>
												</div>
											</div>
										</div>
										<div class="col-md-4  ">
											<div class="card journel_card text-center">
											<a href="archives.php?type=2">	<img class="card-img-top mx-auto img-fluid" src="img/journal_social.png" alt="Card image"> </a>
												<div class="card-body">
													<a href="journal_social_board.php">Editorial Board</a>
												</div>
											</div>
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
												</div>
<br/>
<br/>
<?php require_once('footer.php'); ?>
<script src="editor/js/Al_script.js"></script>

<?php if(isset($_GET['err'])): ?>
	<script>
		$('.input_border').css({
			'border-color' : 'red'
		});
	</script>
<?php endif; ?>