<?php
  require 'header.php';
?>
<?php
	if(isset($_SESSION['u_id'])){
		require 'signout.php';
	}
	else{
		require 'useractions.php';
	}
?>

<section class="section">
  <div class="container">
		<?php
			require 'includes/database.php';
		?>
	</div>
</section>

<?php
  require 'footer.php';
?>
