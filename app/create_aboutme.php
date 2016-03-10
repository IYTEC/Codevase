<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/functions.php"); ?>
<?php require_once("../functions/validation_functions.php"); ?>
<?php require_once("../config/database_connection.php"); ?>
<?php $page_title = "Update About Me"; ?>

<?php if(isset($_POST["submit"])){
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$about_me = $_POST["about_me"];
	$author_id = (int) $_POST["author_id"];
	
	$values_to_validate = array("name", "phone","about_me", "author_id");
	has_presence($values_to_validate);
	if(empty($errors)){
		$query = "INSERT INTO about_admins (name, phone, about_me, author_id) VALUES ('$name', '$phone', '$about_me', $author_id)";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if($result){
			$_SESSION["message"] = "About Me Page Created Successfully";
			redirect_to("views/admin_menu.php");
		}else{
			$_SESSION["message"] = "Opps Something Happened, About Me could not be created";
			redirect_to("new_aboutme.php");
		}
	}else{
		$_SESSION["message"] = "There was an error in your form. Please Check the Error and Try Again";
		$_SESSION["errors"] = $errors;
		redirect_to("new_aboutme.php");
	}
	
}else{
	redirect_to("new_aboutme.php");
}

?>
