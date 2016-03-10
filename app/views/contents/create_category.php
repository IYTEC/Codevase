<?php require_once("../../../functions/sessions.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php require_once("../../../functions/validation_functions.php"); ?>
<?php require_once("../../../config/database_connection.php"); ?>

<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("../login.php");
}
?>
<?php $category = find_category($_GET["category"]) ?>

<?php 
	if(isset($_POST["submit"])){
		$category_name = $_POST["category_name"];
		$description = $_POST["description"];
		
		$values = array("category_name", "description");
		has_presence($values);
		if(empty($errors)){
			$query = "INSERT INTO categories( ";
			$query .= " category_name, description ) VALUES";
			$query .= " ('$category_name','$description')";
			$result = mysqli_query($connection, $query);
			confirm_query($result);
			if($result){
				$_SESSION["message"] = "Category Created Successfully";
				redirect_to("manage_content.php");
			}else{
				$_SESSION["message"] = "Category could not be created";
				redirect_to("manage_content.php?");
			}
		}else{
			$_SESSION["errors"] = $errors;
			redirect_to("new_category.php");
		}
	}else{
		$_SESSION["message"] = "Something is wrong somewhere";
		redirect_to("new_category.php");
		}
	
?>
