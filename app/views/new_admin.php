<?php require_once("../../functions/sessions.php"); ?>
<?php require_once("../../functions/functions.php"); ?>
<?php require_once("../../functions/validation_functions.php"); ?>
<?php require_once("../../config/database_connection.php"); ?>
<?php $page_title = "New Admin"; ?>

<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("login.php");
}
?>
<?php 
if(isset($_POST["submit"])){
	$username = $_POST["username"];
	$password = password_encrypt($_POST["password"]);
	$name = $_POST["name"];
	
	$values = array("name", "username","password");
	has_presence($values);
	if(empty($errors)){
		$query = "INSERT INTO users (";
		$query .=" username, hashed_password, name) ";
		$query .=" VALUES ( '$username', '$password', '$name')";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if($result){
			redirect_to("manage_admin.php");
		}
	}else{
		$_SESSION["errors"] = $errors;
	}
}
?>
<?php include_once("layouts/header.php"); ?>
<h2 class="container">New Admin</h2>
<div id="main">
<div class="container">
	<div class="col-xs-6">
		<?php echo message(); ?>
		<?php# $errors = errors(); ?>
		<?php echo form_errors($errors); ?>
		<form method="post" action="new_admin.php" id="login-form">
			<div class="form-group">
			<label for="exampleInputEmail1">Name</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Name">
		  </div>
			<div class="form-group">
			<label for="exampleInputEmail1" >Username</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Username">
		  </div>
		  <div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  <button id="login-form-submit" name="submit" type="submit" class="btn btn-default">Create Admin</button>
		</form>
	</div>
	<h4><a href="manage_admin.php">&laquo; Manage Admin</a></h4>
</div>
	
</div>
<?php include_once("layouts/footer.php"); ?>
