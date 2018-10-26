<?php
	/*
	This section only displays when the user is signed in.
	It indicates the currently signed in user and has a button that signs the user out
	*/
?>
<section class="section" id="userLogout" style="display: none">
	<div class="container center">
		<h5 id="signedin-as">You are currently logged in as </h5>
		<?php
			if(isset($_SESSION['token'])){
				echo ("The sesion is " .$_SESSION['token']);
			}
		?>
		<form id="signout-form">
			<button type="submit" class="btn waves-effect waves-light blue"name="submit">Sign out</button>
		</form>
	</div>
</section>