<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/functions.php"); ?>
<?php require_once("../config/database_connection.php"); ?>
<?php $page_title = "About Me"; ?>


<?php include_once("views/layouts/header.php"); ?>
<?php $all_admin = authors_set(); ?>

	<div id="main">
		<div class="container-fluid"> 
			<div class="row">
				<div class="col-xs-8 col-md-8">
					<div class="container">
						<h2>Know Our Admins</h2>
						<table class="table">
							<thead>
								<th>Name</th>
								<th>Phone</th>
								<th>Content Authored</th>
								<?php if(isset($_SESSION["user_id"])){ ?>
									<th>Actions</th>
								<?php } ?>
							</thead>
							<?php $all_about_admin = about_admin_set(); ?>
						<?php while($about_admin = mysqli_fetch_assoc($all_about_admin)){ ?>
							<tr>
								<td><?php echo strtoupper($about_admin["name"]); ?></td>
								<td><?php echo $about_admin["phone"]; ?></td>
								<?php $author_contents = author_article_set($about_admin["author_id"]); ?>
								<?php $author_contents = mysqli_num_rows($author_contents); ?>
								<td><a href="">Authored <?php echo $author_contents; ?>&nbsp; Contents</a></span></td>
						<?php if(isset($_SESSION["user_id"])){ ?>
								<td><a href="edit_aboutme.php?admin=<?php echo $about_admin["id"]; ?>"><b>Edit</b></a></td>
								<td onclick="return confirm('Are you sure you want to delete <?php echo ucfirst($about_admin["name"]); ?>');"><a href="delete_aboutme.php?admin=<?php echo $about_admin["id"]; ?>"><b>Delete</b></a></td>
						<?php } ?>
								<td><a href="show_aboutme.php?admin=<?php echo $about_admin["id"]; ?>">Show this Admin</a></td>
							</tr>
						<?php }	?>
	
						</table>
						<?php if(isset($_SESSION["user_id"])){ ?>
							<h5><a href="new_aboutme.php">+ Add About Me</a></h5>
						<?php } ?>
					</div>
					<?php if(isset($_SESSION["user_id"])){ ?>
						<h4><a href="views/admin_menu.php">&laquo; Back to Admin Menu</a></h4>
					<?php } ?>
					&nbsp;&nbsp;
				</div>
				<div class="col-xs-4 col-md-4"> 
					<?php if(isset($_SESSION["user_id"])){ ?>
						<h4><a href="contents/manage_content.php">Manage Content</a></h4>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php include_once("views/layouts/footer.php"); ?>
