<?php ?>
<section class="section" id="userActions">
	<div class="container">
		<div class="row center">
			<h5>You are not logged in!</h5>
			<p>Choose one of the following</p>
		</div>
		<div class="row">
			<div class="col s12 m12 l6 center">
				<h5>Sign In</h5>
				<form method="POST" id="signin-form">
					<input type="text" name="uid" placeholder="Username">
					<input type="password" name="pwd" placeholder="Password">
					<input type="hidden" name="submit">
					<button type="submit" class="btn waves-effect waves-light blue" name="submit">Sign In
						<i class="material-icons right">send</i>
					</button>
				</form>
			</div>
			<div class="col s12 m12 l6 center">
				<h5>Sign Up</h5>
				<form method="POST" id="signup-form">
					<input type="text" name="first" placeholder="Firstname">
					<input type="text" name="last" placeholder="Lastname">
					<input type="text" name="email" placeholder="E-mail">
					<input type="text" name="uid" placeholder="Username">
					<input type="password" name="pwd" placeholder="Password">
					<button type="submit" id="signup-button" class="btn waves-effect waves-light blue" name="submit">Sign Up
						<i class="material-icons right">send</i>
					</button>
				</form>
			</div>
		</div>
	</div>
</section>

<?php

