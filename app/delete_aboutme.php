<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../config/database_connection.php"); ?>
<?php require_once("../functions/functions.php"); ?>
<?php include_once("views/layouts/header.php"); ?>

<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("views/login.php");
}
?>
<?php 
if(isset($_GET["admin"])){
	$query = " DELETE FROM about_admins WHERE id = {$_GET["admin"]}";
	$result = mysqli_query($connection, $query);
	$_SESSION["message"] = "About Me Page Deleted Successfully";
	confirm_query($result);
	redirect_to("about_me.php");
}else{
	redirect_to("about_me.php");
}
?>