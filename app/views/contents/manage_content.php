<?php require_once("../../../functions/sessions.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php require_once("../../../functions/validation_functions.php"); ?>
<?php require_once("../../../config/database_connection.php"); ?>
<?php $page_title = "Manage Contents"; ?>

<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("../login.php");
}
?>
<?php include_once("../layouts/header.php"); ?>
<?php
	find_category_or_article();
?>
		<div class="container-fluid"> <!-- The content of the page starts Here -->
			<div class="row"  id="main">
				<div class="col-xs-9">
				<div>
					<?php echo message(); ?>
					<?php $errors = errors(); ?>
					<?php echo form_errors($errors); ?>
					<div class="container">
						<?php if($cat_description){ ?>
							<div>
								<?php echo $cat_description["description"]; ?>
							</div>
							<div>
								<span>
									<a href="cat_edit.php?category=<?php echo $cat_description["id"]; ?>">Edit</a>
								</span>
								&nbsp;
								<span onclick="confirm('Are you sure you want to delete this Category?');">
									<a href="cat_delete.php?category=<?php echo $cat_description["id"]; ?>">Delete</a>
								</span>
							</div>
						<?php }elseif($article_content){ ?>
							<?php $find_categories = category_description($article_content["category_id"]); ?>
							<h3><?php echo $find_categories["category_name"]; ?> </h3>
							<div class="container">
								<div class="text-justify">
									<?php echo $article_content["content"]; ?>
								</div>
							</div>
							<div>
								<span style="font-size: 110%; font-weight: bold;">
									<a href="../articles/edit_article.php?article=<?php echo $article_content["id"]; ?>">Edit</a>
								</span>
								&nbsp;
								&nbsp;
								&nbsp;
								<span onclick="confirm('Are you sure you want to delete this Category?');" style="font-size: 110%; font-weight: bold;">
									<a href="../articles/delete_article.php?article=<?php echo $article_content["id"]; ?>">Delete</a>
								</span>
							</div>
							
						<?php }else{ echo null;	} ?>
					</div>
				</div>
				</div>
				<div style="border-left: solid;" id="navigation" class="col-xs-2 col-xs-push-1"> <!-- The Navigation bar starts here -->
					<h4><label for="categories">Categories: </label></h4>
					<?php $categories = category_set(); ?>
						<div class="text-left">
					<?php while($category = mysqli_fetch_assoc($categories)){ ?> 
					<ul class="text-left">
							<li>
								<span>
								<a href="manage_content.php?category=<?php echo $category["id"]; ?>"><?php echo $category["category_name"]; ?>
								</a>
								</span>
							</li>
								<?php $articles = articles_set($category["id"]); ?>
								<?php while($article = mysqli_fetch_assoc($articles)){ ?>
							<ul class="text-left">
									<li>
										<span>
										<a href="manage_content.php?article=<?php echo $article["id"]; ?>"><?php echo $article["title"]; ?></a>
										</span>
									</li>
							</ul>
							<?php } ?>
							<?php mysqli_free_result($articles); ?>
					</ul>
					<?php } ?>
						</div>
					<?php mysqli_free_result($categories); ?>
				<br/>
					<h5  class="text-center"><a href="new_category.php">&laquo; Add New Category</a></h5>
				<br/><br/><br/><br/>
				</div>
			</div>
			<br />
			<h4><a href="../admin_menu.php">&laquo; Back to Admin Menu</a></h4>
			</div>
		</div>
<!--	</div>-->
<?php include_once("../layouts/footer.php"); ?>
