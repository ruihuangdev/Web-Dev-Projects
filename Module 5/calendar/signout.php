<section class="section" id="userLogout">
	<div class="container center">
		<h5>You are currently logged in as <?php echo $_SESSION['u_id']; ?></h5>
		<form action="includes/logout.inc.php" method="POST" class="signin-form">
			<button type="submit" class="btn waves-effect waves-light blue"name="submit">Sign out</button>
		</form>
	</div>
</section>