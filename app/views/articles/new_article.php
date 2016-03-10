<?php require_once("../../../functions/sessions.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php require_once("../../../functions/validation_functions.php"); ?>
<?php require_once("../../../config/database_connection.php"); ?>
<?php $page_title = "Create New Article"; ?>

<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("../login.php");
}
?>
<?php include_once("../layouts/header.php"); ?>

<?php 
	if(isset($_GET["category"])){
		$category = find_article_by_category($_GET["category"]);
	}
	else{
		$category = null;
	}
?>

	<div id="main">
		<div class="container-fluid"> <!-- The content of the page starts Here -->
			<h2>Add New Article</h2>
			<div class="row">
				<div class=col-md-8>
				<?php echo message(); ?>
				<?php $errors = errors(); ?>
				<?php echo form_errors($errors); ?>
					<div class="container col-xs-9">
						<form id="login-form" method="post" action="create_article.php">
							<div class="form-group">
								<label>Title: </label><input type="text" class="form-control" name="title" value="" />
							</div>
							<div class="form-group">
							<label>Category: </label>
							<select class="form-control" name="category_id">
								<?php $category = category_set(); ?>
								<?php $category = mysqli_num_rows($category); ?>
								<?php for($count = 1; $count <= $category; $count++){ ?>
								<?php echo "<option value=\"$count\">$count </option>"; ?>
								<?php } ?>
							</select>
							</div>
							<div class="form-group">
							<label>Author: </label>
							<select class="form-control" name="author_id">
								<?php $authors = authors_set(); ?>
								<?php $authors = mysqli_num_rows($authors); ?>
								<?php for($count = 1; $count <= $authors; $count++){ ?>
								<?php echo "<option value=\"$count\">$count </option>"; ?>
								<?php } ?>
							</select>
							</div>
							<div class="form-group">
								<label>Content: </label>&nbsp;<textarea class="form-control" name="content" cols="60" rows="24"></textarea>
							</div>
							<p>
							<input class="btn btn-primary" type="submit" name="submit" value="Submit Article" />
							</p>
						</form>
					</div>
				</div>
				<div class="col-md-4"> <!-- The Navigation bar starts here -->
					<h4><a href="../contents/manage_content.php">&laquo; Manage Content</a></h4>
				</div>
			</div>
		</div>
	</div>
<?php include_once("../layouts/footer.php"); ?>
