<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/functions.php"); ?>
<?php require_once("../config/database_connection.php"); ?>
<?php include_once("views/layouts/header.php"); ?>

<?php 
	if(isset($_GET["admin"])){
		$aboutid = mysql_prep($_GET["admin"]);
		$aboutme = find_about_me_by_id($aboutid);
	}
?>
		<div class="container-fluid"> <!-- The content of the page starts Here -->
			<div class="row"  id="main">
				<div class="col-xs-9">
					<h2><?php echo  ucwords($aboutme["name"]); ?></h2>
					<?php echo $aboutme["about_me"]; ?>
				</div>
				<div style="border-left: solid;" id="navigation" class="col-xs-2 col-xs-push-1"> <!-- The Navigation bar starts here -->
					
				</div>
			</div>
		</div>
<?php require_once("../app/views/layouts/footer.php"); ?>
