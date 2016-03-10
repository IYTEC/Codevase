<?php require_once("../../../config/database_connection.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php include_once("../layouts/header.php"); ?>
<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("../login.php");
}
?>
<?php 
if(isset($_GET["article"])){
	$query = "DELETE FROM articles WHERE id = {$_GET["article"]}";
	$result = mysqli_query($connection, $query);
	confirm_query($result);
	redirect_to("../contents/manage_content.php");
}else{
	redirect_to("../contents/manage_content.php");
}
?>