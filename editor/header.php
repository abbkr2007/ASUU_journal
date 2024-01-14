<?php
// Start the session
session_start();
require_once('config.php');
if (!isset($_SESSION['username'])) {
	header("Location: /login");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home - ASUU Ejournals</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- custom css -->
	<link rel="icon" href="../img/favicon.png">
	<!-- fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/editor_board.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/AL_Developer.css">
	<style>
		.dropdown-menu.al-menu-right {
			left: -214px;
		}

		.search-field.all {
			margin: 0 10px;
		}

		.site-footer {
			position: fixed;
			bottom: 0;
			width: 100%;
			z-index: 11111;
		}

		.main_content {
			margin-bottom: 100px;
		}
	</style>
</head>

<body>
	<div class="main-body">


		<header id="main_header" class="fixed-top">
			<div class="header_wrapper">


				<!-- nav header starts -->
				<nav id="navbar_main" class="navbar navbar-expand-md h-100">
					<!-- Brand -->
					<a class="navbar-brand" href="#"><img src="img/logoj.png"></a>

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
								<a class="nav-link" href="#"><span>Current issue</span></a>
							</li>

							<li class="dropdown nav-item my-auto">
								<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><span>For Authors</span> </a>
								<ul class="dropdown-menu" role="menu" style="display: none;">
									<li nav-item my-auto><a class="" href="journal-of-humanitise.php"><span>ASUU Journal of Humanities
											</span> </a></li>
									<li nav-item my-auto><a class="" href="journal-social-science.php"><span>ASUU Journal of Social Sciences
											</span> </a></li>
									<li nav-item my-auto><a class="" href="journal-science.php"><span>ASUU Journal of Science
											</span> </a></li>

								</ul>
							</li>
							<li class="nav-item my-auto al-md">
								<a class="nav-link" href="upload_article.php"><span>Upload article</span></a>
							</li>
							<!-- <li class="dropdown nav-item my-auto">
							<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><span>User</span> </a>
							<ul class="dropdown-menu" role="menu" style="display: none;">
								<li nav-item my-auto><a class="" href="add-user.php"><span>Add User</span> </a></li>                
								<li nav-item my-auto><a class="" href="list-user.php"><span>List User</span> </a></li>                     
							</ul>
						</li> -->
							<li class="nav-item my-auto pr-3 d-none d-lg-block">
								<span>
									Hi : <?php
											$alif = $pdo->prepare("SELECT fname,onames FROM ejournal_users WHERE email=?");
											$alif->execute(array($_SESSION['username']));
											$data_array = $alif->fetchAll(PDO::FETCH_ASSOC);
											$first_name = $data_array[0]['fname'] . ' ' . $data_array[0]['onames'];
											echo $first_name;
											?>

								</span>
							</li>
							<li class="dropdown nav-item my-auto">
								<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><span> <i class="fas fa-user    "></i> </span> </a>
								<ul class="dropdown-menu al-menu-right" role="menu" style="display: none;">
									<li nav-item my-auto><a class="" href="user-profile.php"><span>Profile
											</span> </a></li>
									<li nav-item my-auto><a class="" href="add-user.php"><span>Add User</span> </a></li>
									<li nav-item my-auto><a class="" href="list-user.php"><span>List of Reviewers</span> </a></li>
									<li nav-item my-auto><a class="" href="change-passwod.php"><span>Change Password
											</span> </a></li>
									<li nav-item my-auto><a class="" href="logout.php"><span>logout
											</span> </a></li>


								</ul>
							</li>
						</ul>
					</div>
				</nav>
				<!-- nav header ends -->



			</div>
		</header>