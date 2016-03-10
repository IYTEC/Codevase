<script src="../../../../codecrafter/app/assets/javascripts/bootstrap.js" type="application/javascript"></script>
<footer class="navbar navbar-inverse">
			<div class="container-fluid">
				  <ul class="nav navbar-nav navbar-right">
					<li><a href="#">Facebook</a></li>
					<li><a href="#">Twitter</a></li>
					<li><a href="#">Linked in</a></li>
					<li><a href="#">Github</a></li>
				  </ul>
				 <ul class="nav navbar-nav">
					<li><a href="">Copyright&copy; <?php echo date("Y"); ?></a></li>
				  </ul>
			</div> 
		</footer>
	</body>
</html>
<?php 
if(isset($connection)){
	mysqli_close($connection);
}
?>