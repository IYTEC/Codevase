<?php require_once("../../../config/database_connection.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php include_once("../layouts/header.php"); ?>

<?php 
	if(isset(_GET["category"])){
		$category = find_category($_GET["category"]); 
	}
?>
<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("../login.php");
}
?>
<?php 
if(isset($_GET["category"])){
	$query = "DELETE FROM categories WHERE id = {$_GET["category"]}";
	$result = mysqli_query($connection, $query);
	confirm_query($result);
	redirect_to("manage_content.php");
}else{
	redirect_to("manage_content.php");
}
?>