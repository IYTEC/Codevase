<?php require_once("../../functions/sessions.php"); ?>
<?php require_once("../../functions/functions.php"); ?>
<?php require_once("../../functions/validation_functions.php"); ?>
<?php require_once("../../config/database_connection.php"); ?>
<?php $page_title = "Admin Menu"; ?>

<?php include_once("layouts/header.php"); ?>
<?php $confirm_logged_in = confirm_logged_in($_SESSION["user_id"]); ?>
<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("login.php");
}
?>
	<div id="main">
		<div class="container-fluid"> <!-- The content of the page starts Here -->
			<div class="row">
				<div class=col-md-8>
					<?php echo message(); ?>
		<?php# $errors = errors(); ?>
		<?php echo form_errors($errors); ?>
					<div class="container">
							<h2> Welcome to the Admin Page <?php echo ucfirst($logged_in_user["username"]); ?></h2>
						<ul id="admin_menu">
							<li><h4><a href="contents/manage_content.php">Manage Content</a></h4></li>
							<li><h4><a href="manage_admin.php">Manage Admin</a></h4></li>
							<li><h4><a href="../about_me.php">Manage About Me Page</a></h4></li>
							<li><h4><a href="logout.php">Logout</a></h4></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4"> <!-- The Navigation bar starts here -->
					
				</div>
			</div>
		</div>
	</div>
<?php include_once("layouts/footer.php"); ?>
