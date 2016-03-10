<?php require_once("../../../functions/sessions.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php require_once("../../../functions/validation_functions.php"); ?>
<?php require_once("../../../config/database_connection.php"); ?>
<?php $page_title = "Edit Category"; ?>

<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("../login.php");
}
?>
<?php include_once("../layouts/header.php"); ?>
<?php $category = find_category($_GET["category"]) ?>
<?php if(isset($_POST["submit"])){
	$cat_name = $_POST["category_name"];
	$cat_description = $_POST["description"];
	$id = (int) $_GET["category"];
	
	$value = array("category_name", "description");
	has_presence($value);
	if(empty($errors)){
		$query = "UPDATE categories SET category_name = '{$cat_name}', description = '{$cat_description}' WHERE id = {$id}";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if($result && mysqli_affected_rows($connection) >= 0){
			$_SESSION["message"] = "Category Updated Successfully";
			redirect_to("manage_content.php?category={$id}");
		}else{
			$_SESSION["message"] = "Category could not be updated";
			redirect_to("manage_content.php");
		}
	}else{
		$_SESSION["message"] = "Something is wrong somewhere";
	}
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
						<div class="col-xs-offset-1 col-xs-7">
						<form method="post" id="login-form" action="cat_edit.php?category=<?php echo $cat_content["id"]; ?>">
							<div class="form-group">
								<label>Category Name: </label>
								<input type="text" class="form-control" name="category_name" value="<?php echo $cat_content["category_name"]; ?>" />
							</div>
							<div class="form-group">
								<label>Description: </label>&nbsp;
								<textarea class="form-control" name="description" cols="60" rows="24"><?php echo $cat_content["description"]; ?></textarea>
							</div>
							<div class="form-group">
								<input class="btn btn-primary" type="submit" name="submit" value="Update Category" />
							</div>
						</form>
					</div>
					</div>
				</div>
				<div class="col-md-4"> <!-- The Navigation bar starts here -->
					<b><a href="manage_content.php">&laquo; Manage Content</a></b>
				</div>
			</div>
		</div>
	</div>
<?php include_once("../layouts/footer.php"); ?>
