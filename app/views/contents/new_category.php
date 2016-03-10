<?php require_once("../../../functions/sessions.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php require_once("../../../functions/validation_functions.php"); ?>
<?php require_once("../../../config/database_connection.php"); ?>
<?php $page_title = "New Category"; ?>

<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("../login.php");
}
?>
<?php include_once("../layouts/header.php"); ?>
	<div id="main">
		<div class="container-fluid"> <!-- The content of the page starts Here -->
			<div class="row">
				<div class=col-md-8>
					<?php echo message(); ?>
					<?php $errors = errors(); ?>
					<?php echo form_errors($errors); ?>
					<div class="container col-xs-9">
						<form method="post" action="create_category.php" id="login-form">
							<div class="form-group">
								<label>Category Name</label>
								<input type="text" class="form-control" name="category_name" value="" />
							</div>
							<div class="form-group">
								<label>Description: </label>&nbsp;
								<textarea class="form-control" name="description" cols="60" rows="24"></textarea>
							</div>
							<div class="form-group">
							<input class="btn btn-primary" type="submit" name="submit" value="Submit Category" />
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-4"> <!-- The Navigation bar starts here -->
					<h4><a href="manage_content.php">&laquo; Manage Content</a></h4>
				</div>
			</div>
		</div>
	</div>
<?php include_once("../layouts/footer.php"); ?>
