<?php require_once("../../../functions/sessions.php"); ?>
<?php require_once("../../../functions/functions.php"); ?>
<?php require_once("../../../functions/validation_functions.php"); ?>
<?php require_once("../../../config/database_connection.php"); ?>
<?php $page_title = "Edit Article"; ?>
<?php if(confirm_logged_in($_SESSION["user_id"])){
	$logged_in_user = find_admin_by_username($_SESSION["username"]);
}else{
	redirect_to("..login.php");
}
?>
<?php
if(isset($_POST["submit"])){
	$content = $_POST["content"];
	$title = $_POST["title"];
	$category_id = (int) $_POST["category_id"];
	$author_id = (int) $_POST["author_id"];
	$id = (int) $_GET["article"];
	
	$values = array("title", "content");
	has_presence($values);
		if(empty($errors)){
		$query = "UPDATE articles SET category_id = {$category_id}, title = '{$title}', content= '{$content}', author_id = {$author_id} WHERE id = {$id}";
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if($result){
			$_SESSION["message"] = "Article Updated Successfully";
			redirect_to("../contents/manage_content.php?article={$id}");
		}else{
			$_SESSION["message"] = "Article could not be updated";
		}
	}else{
			$_SESSION["message"] = "Something went wrong";
		}
}
?>
<a href="../contents/manage_content.php"
<?php
if(isset($_GET["article"])){
	$article_edit = all_article_content($_GET["article"]);
}else{
	redirect_to("../contents/manage_content.php");
}

?>

<?php include_once("../layouts/header.php"); ?>
	<div id="main">
		<div class="container-fluid"> <!-- The content of the page starts Here -->
			<div class="row">
				<div class=col-md-8>
					<?php echo message(); ?>
					<?php# $errors = errors(); ?>
					<?php echo form_errors($errors); ?>
					<div class="col-xs-offset-1 container">
						<h2>Edit Article</h2>
						<form id="login-form" method="post" action="edit_article.php?article=<?php echo $article_edit["id"]; ?>">
							<div class="container">
							<div class="form-group">
								<label>Title: </label>
								<input type="text" class="form-control" name="title" value="<?php echo $article_edit["title"]; ?>" />
							</div>
							<div class="form-group">
							<label>Category: </label>
							<select class="form-control" name="category_id">
								<?php $category = category_set(); ?>
								<?php $category = mysqli_num_rows($category); ?>
								<?php for($count = 1; $count <= $category; $count++){ 
									echo "<option value=\"$count\"";
									if($article_edit["category_id"] == $count){
									echo "selected";
									}
									echo ">$count </option>";
								 } ?>
							</select>
							</div>
							<div class="form-group">
							<label>Authors: </label>
							<select class="form-control" name="author_id">
								<?php $authors = authors_set(); ?>
								<?php $authors = mysqli_num_rows($authors); ?>
								<?php for($count = 1; $count <= $authors; $count++){ 
									echo "<option value=\"$count\"";
									if($article_edit["author_id"] == $count){
									echo "selected";
									}
									echo ">$count </option>";
								} ?>
							</select>
							</div>
							<div class="form-group">
								<label>Content: </label>&nbsp;<textarea class="form-control" name="content" cols="60" rows="24"><?php echo $article_edit["content"]; ?></textarea>
							</div>
							<div class="form-group">
							<input class="btn btn-primary" type="submit" name="submit" value="Update Article" />
							</div>
								</div>
						</form>
					</div>
				</div>
				<div class="col-md-4"> <!-- The Navigation bar starts here -->
					<h4><a href="../contents/manage_content.php">&laquo; Manage Content</a></h4>
				</div>
			</div>
		</div>
	</div>
<?php include_once("../layouts/footer.php"); ?>

