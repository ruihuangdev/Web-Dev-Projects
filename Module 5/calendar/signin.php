<?php
	include_once 'header.php';
?>

<section class="section">
	<div class="container">
		<h2>Sign In</h2>
		<form action="includes/login.inc.php" method="POST" class="signin-form">
			<input type="text" name="uid" placeholder="Username">
			<input type="password" name="pwd" placeholder="Password">
			<button type="submit" class="btn waves-effect waves-light blue"name="submit">Sign In
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</section>

<?php
	include_once 'footer.php';
?>
