<?php require_once("../../../functions/sessions.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php require_once("../../../functions/validation_functions.php"); ?>
<?php require_once("../../../config/database_connection.php"); ?>
<?php include_once("../layouts/header.php"); ?>
<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("../login.php");
}
?>
<?php 
	if(isset($_POST["submit"])){
		$author_id = (int) $_POST["author_id"];
		$category_id = (int) $_POST["category_id"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		
		$values = array("title", "content");
		has_presence($values);
		if(!empty($errors)){
			$_SESSION["errors"] = $errors;
			redirect_to("new_article.php");
		}
		$query = "INSERT INTO articles (author_id, category_id, content, title) VALUES ({$author_id}, {$category_id}, '{$content}', '{$title}')";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if($result){
			redirect_to("../contents/manage_content.php");
			$_SESSION["message"] = "Article Created Successfully"
		}else{
			redirect_to("new_article.php");
		}
	}else{
			$_SESSION["message"] = "Something is wrong somewhere."
			redirect_to("../contents/manage_content.php");
	}
?>

<?php include_once("../layouts/footer.php"); ?>
