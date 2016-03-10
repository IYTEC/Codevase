<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/functions.php"); ?>
<?php require_once("../functions/validation_functions.php"); ?>
<?php require_once("../config/database_connection.php"); ?>
<?php $page_title = "Update About Me"; ?>

<?php 
if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("views/login.php");
}
?>

<?php 
	if(isset($_POST["submit"])){
		$name = $_POST["name"];
		$phone = $_POST["phone"];
		$aboutme = $_POST["about_me"];
		$author_id = (int) $_POST["author_id"];
		$id = (int)	$_GET["admin"];
		
		$values_to_validate = array("name", "phone", "about_me", "author_id");
		has_presence($values_to_validate);
		if(empty($errors)){
			$query = "UPDATE about_admins SET name = '$name', phone = '$phone', about_me = '$aboutme', author_id = $author_id WHERE id =  $id";
			$result = mysqli_query($connection, $query);
			confirm_query($result);
			if($result && mysqli_affected_rows($connection) >= 0){
				$_SESSION["message"] = "About Me Page Updated Successfully.";
				redirect_to("about_me.php");
			}else{
				$_SESSION["message"] = "Unable to Update About Me page";
			}
		}else{
			$_SESSION["errors"] = $errors;
			$_SESSION["message"] = "Please Fix the following Errors and Submit Again";
		}
	}else{
		#$_SESSION["message"] = "Something Went Wrong, Please Check your URL.";
	}
?>
<?php 
	if(isset($_GET["admin"])){
		$aboutme = find_about_me_by_id($_GET["admin"]); 
	}else{
		$aboutme = null;
	}

?>
<?php include_once("views/layouts/header.php"); ?>

	<div id="main">
		<div class="container-fluid"> <!-- The content of the page starts Here -->
			<h2>Edit About Me</h2>
			<div class="row">
				<div class=col-md-8>
				<?php echo message(); ?>
				<?php# $errors = errors(); ?>
				<?php echo form_errors($errors); ?>
					<div class="container col-xs-9">
						<form id="login-form" method="post" action="edit_aboutme.php?admin=<?php echo $aboutme["id"]; ?>">
							<div class="form-group">
								<label>Name: </label><input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $aboutme["name"]; ?>" />
							</div>
							<div class="form-group">
								<label>Phone: </label><input type="tel" class="form-control" name="phone" placeholder="Phone Number" value="<?php echo $aboutme["phone"]; ?>" />
							</div>
							<div class="form-group">
							<label>Author ID: </label>
							<select class="form-control" name="author_id">
								<?php $authors = authors_set(); ?>
								<?php $authors = mysqli_num_rows($authors); ?>
								<?php for($count = 1; $count <= $authors; $count++){ ?>
								<?php echo "<option value=\"$count\">$count </option>"; ?>
								<?php } ?>
							</select>
							</div>
							<div class="form-group">
								<label>About Me: </label>&nbsp;<textarea class="form-control" name="about_me" cols="60" rows="24"><?php echo $aboutme["about_me"]; ?></textarea>
							</div>
							<div class="form-group">
								<input class="btn btn-primary" type="submit" name="submit" value="Update About Me" />
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-4"> <!-- The Navigation bar starts here -->
					<h4><a href="views/contents/manage_content.php">&laquo; Manage Content</a></h4>
				</div>
			</div>
		</div>
	</div>
<?php include_once("views/layouts/footer.php"); ?>
