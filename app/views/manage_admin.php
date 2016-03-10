<?php require_once("../../functions/sessions.php"); ?>
<?php require_once("../../functions/functions.php"); ?>
<?php require_once("../../config/database_connection.php"); ?>
<?php $page_title = "Manage Admins"; ?>

<?php $confirm_logged_in = confirm_logged_in($_SESSION["user_id"]); ?>
<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("login.php");
}
?>
<?php include_once("layouts/header.php"); ?>
<?php $all_admin = authors_set(); ?>

	<div id="main">
		<div class="container-fluid"> 
			<div class="row">
				<div class="col-xs-8 col-md-8">
					<div class="container">
						<h2>All Admins</h2>
						<table class="table">
							<thead>
								<th>Username</th>
								<th>Actions</th>
							</thead>
						<?php while($admin = mysqli_fetch_assoc($all_admin)){ ?>
							<tr>
								<td><?php echo strtoupper($admin["username"]); ?></td>
								<td><a href="edit_admin.php?admin=<?php echo $admin["id"]; ?>"><b>Edit</b></a></td>
								<td onclick="return confirm('Are you sure you want to delete <?php echo ucfirst($admin["username"]); ?>');"><a href="delete_admin.php?admin=<?php echo $admin["id"]; ?>"><b>Delete</b></a></td>
							</tr>
						<?php }	?>
	
						</table>
						<h5><a href="new_admin.php">+ Add New Admin</a></h5>
					</div>
					
					<h4><a href="admin_menu.php">&laquo; Back to Admin Menu</a></h4>
					&nbsp;&nbsp;
				</div>
				<div class="col-xs-4 col-md-4"> 
					<h4><a href="contents/manage_content.php">Manage Content</a></h4>
				</div>
			</div>
		</div>
	</div>
<?php include_once("layouts/footer.php"); ?>
