<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/functions.php"); ?>
<?php# require_once("functions/validation_functions.php"); ?>
<?php require_once("../config/database_connection.php"); ?>
<?php require_once("../app/views/layouts/header.php"); ?>
<?php $page_title = "Home"; ?>
<?php find_category_or_article(); ?>
		<div class="container-fluid"> <!-- The content of the page starts Here -->
			<div class="row"  id="main">
				<div class="col-xs-9">
					<?php echo message(); ?>
					<?php# $errors = errors(); ?>
					<?php# echo form_errors($errors); ?>
					<?php if(isset($cat_description)){ ?>
						<h3><a href="index.php?category=<?php echo $cat_description["id"]; ?>"><?php echo $cat_description["category_name"]; ?></a></h3>
						<?php $all_article = find_article_by_category($cat_description["id"]); ?>
						<?php while($article = mysqli_fetch_assoc($all_article)){ ?>
					<div>
						<div>
						<span style="font-size: 150%; font-weight: bold;"><?php echo ucfirst($article["title"]); ?></span>&nbsp;&nbsp;
						<span style="font-weight: bold;"><?php echo $article["create_time"]; ?></span>
						</div>
						<?php echo substr($article["content"], 0, 600); ?>
						<a style="font-weight: bold;" href="index.php?article=<?php echo $article["id"]; ?>">  <?php echo strtoupper("Read More"); ?>...</a>
						<br/>
						<hr>
					</div>
						<?php } ?>
					<?php }elseif(isset($article_content)){ ?>
						<h3><?php echo $article_content["title"]; ?></h3>
						<?php echo $article_content["content"]; ?>
					<?php }else{ ?>
						<h1>Welcome</h1>
					<?php } ?>
				</div>
				<div style="border-left: solid;" id="navigation" class="col-xs-2 col-xs-push-1"> <!-- The Navigation bar starts here -->
					<h4 style="margin-left: 20px;"><label for="categories">Categories: </label></h4>
					<?php echo public_navigation($cat_description, $article_content); ?>
				<br/>
				<br/>
<!--				<h4 style="margin-left: 20px;"><a href="views/login.php">Admin Login</a></h4>-->
				</div>
			</div>
			<br />
			</div>
<?php require_once("../app/views/layouts/footer.php"); ?>
