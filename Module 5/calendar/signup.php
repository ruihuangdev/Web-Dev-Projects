<?php
	include_once 'header.php';
?>

<section class="section">
	<div class="container">
		<h2>Sign Up</h2>
		<form action="includes/signup.inc.php" method="POST" class="signup-form">
			<input type="text" name="first" placeholder="Firstname">
			<input type="text" name="last" placeholder="Lastname">
			<input type="text" name="email" placeholder="E-mail">
			<input type="text" name="uid" placeholder="Username">
			<input type="password" name="pwd" placeholder="Password">
			<button type="submit" class="btn waves-effect waves-light blue" name="submit">Sign Up
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</section>

<?php
	include_once 'footer.php';
?>
