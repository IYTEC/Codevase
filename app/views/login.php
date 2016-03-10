<?php require_once("../../functions/sessions.php"); ?>
<?php require_once("../../functions/functions.php"); ?>
<?php require_once("../../functions/validation_functions.php"); ?>
<?php require_once("../../config/database_connection.php"); ?>
<?php $page_title = "Login"; ?>

<?php 
if(isset($_POST["submit"])){
	$username = mysql_prep(strtolower($_POST["username"]));
	$password = mysql_prep($_POST["password"]);
	
	$value = array("username", "password");
	has_presence($value);
	$values = array("username");
	validates_length($values, 30);
	if(empty($errors)){
		$found_user = attempt_login($username, $password);
		if(!$found_user){
			$_SESSION["message"] = "Incorrect username/password combination";
		}else{
			$_SESSION["username"] = $found_user["username"];
			$_SESSION["user_id"] = $found_user["id"];
			$_SESSION["message"] = "You are now signed in";
			redirect_to("admin_menu.php");
		}
	}else{
		$_SESSION["errors"] = $errors;
	}
}

?>
<?php include_once("layouts/header.php"); ?>
<h2 class="container">Admin Login Form</h2>
<div id="main">
<div class="container">
	<div class="col-xs-6">
		<?php echo message(); ?>
		<?php# $errors = errors(); ?>
		<?php echo form_errors($errors); ?>
		<form method="post" action="login.php" id="login-form">
		  <div class="form-group">
			<label for="exampleInputEmail1">Username</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Username">
		  </div>
		  <div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  <button id="login-form-submit" name = "submit" type="submit" class="btn btn-default">Submit</button>
		</form>
		
	</div>
</div>
</div><br />
<?php include_once("layouts/footer.php"); ?>
