<?php require_once('config.php');
session_start();
if (!isset($_SESSION['username'])){ 
  header("Location: /login");
}
$user_email = $_SESSION['username'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>List</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- custom css -->
	<!-- fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
	<div class="main-body list_page">
		

		<header id="main_header" class="fixed-top">
			<div class="header_wrapper">
				

					<!-- nav header starts -->
			<nav id="navbar_main" class="navbar navbar-expand-md h-100">
				<!-- Brand -->
				<a class="navbar-brand" href="#"><img src="img/cone3.jpg"></a>

				<!-- Toggler/collapsibe Button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
				</button>

				<!-- Navbar links -->
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav ml-auto text_custom_center">	
						<li class="nav-item my-auto">
							<a class="nav-link" href="index.php"><span>Home</span> </a>
						</li>
							<li class="nav-item my-auto">
							<a class="nav-link" href="submit_manuscript.php"><span>Current issue</span></a>
						</li>
							<li class="nav-item my-auto">
							<a class="nav-link" href="submit_manuscript.php"><span>Archives</span></a>
						</li>
							<li class="nav-item my-auto">
							<a class="nav-link" href="submit_manuscript.php"><span>For Authors</span></a>
						</li>
						<li class="nav-item my-auto">
							<a class="nav-link" href="submit_manuscript.php"><span>Submit</span></a>
						</li>
						<li class="nav-item my-auto">
							<a class="nav-link" href="#"><span>
							   Welcome : <?php echo $user_email; ?>
							</span></a>
						</li>
						<li class="nav-item">
							<a href="logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- nav header ends -->
				<!-- nav header ends -->


				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="search_bar">
							<div class="input-group">
								<input type="text" class="form-control border-right-0" placeholder="Search...">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-search"></i></span>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</header>

		<main class="main_content">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-10">
						<div class="row">

						<?php  
							$limit = 6;
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
											<li class="list-group-item">Submission Date: <?php echo $row['date_s'];?></li>
											<li class="list-group-item">Journal Type:<?php echo $row['category'];?></li>
											<li class="list-group-item border-0">Publisher: ASUU</li>
										<li class="list-group-item border-0">Status: <?php echo $row['status'];?></li>
										</ul>
									</div>


									<div class="pdf_section">
										<div class="abstract_wrap" data-toggle="modal" data-target="#myModal" type="button">
											<i class="fas fa-caret-right"></i> <span>Abstract</span>
										</div>

										<div class="pdf_wrap">
											<a href=""><img src="img/pdf_icon.png">(2215 Kb)</a>
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
		echo ' <li class="page-item"><a class="page-link" href="mns_tracking_more.php?page='.($page - 1).'">Prev</a></li>';
		}			
		for ($i=1; $i<=$total_page; $i++) { 
			if($i == $page){
			$active = "active";
			}
			else{
				$active = "";
			}
			echo '<li class="page-item"><a class="page-link'
			." ".$active.'" href="mns_tracking_more.php?page='.$i.'">'.$i.'</a></li>';
		}
		if($total_page > $page){
		echo '<li class="page-item"><a class="page-link" href="mns_tracking_more.php?page='.($page + 1).'">Next</a></li>';
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
						<iframe src="Abstract.pdf" style="width:100%; height:600px;" frameborder="0"></iframe>					</div>


				</div>
			</div>
		</div>

	</div>
	<!-- scripts -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>