<?php #require_once("../../functions/sessions.php"); ?>
<?php# require_once("../../functions/functions.php"); ?>
<a href=
<!DOCTYPE html>
<html>
    <head>
		<?php $title = isset($page_title) ? $page_title : "Home"; ?>
		<title><?php echo $title; ?></title>
<!--		<link href="/codecrafter/app/assets/stylesheets/public.css" type="text/css" rel="stylesheet" />-->
		<link href="/codecrafter/app/assets/stylesheets/bootstrap.css" type="text/css" rel="stylesheet" />
		<link href="/codecrafter/app/assets/stylesheets/default.css" type="text/css" rel="stylesheet" />
		<link href="/codecrafter/app/assets/javascripts/bootstrap.js" type="text/javascript" rel="javascript" />
	</head>
	<body>
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="#">Code Crafter</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav navbar-right">
					<li><a href="../../../../codecrafter/app/index.php">Tutorial</a></li>
					<li><a href="../../../../codecrafter/app/about_me.php">About Admins</a></li>
					<li><a href="#">Contact</a></li>
					<?php if(isset($_SESSION["user_id"])){ ?>
					  <li><a href="../../../../codecrafter/app/views/logout.php">Logout</a></li>
					<?php }else{ ?>
					  <li><a href="../../../../codecrafter/app/views/login.php">Admin Login</a></li>
					 <?php } ?>
				  </ul>
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		
	