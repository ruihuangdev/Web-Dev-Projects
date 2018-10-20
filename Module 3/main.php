<?php
  include_once 'header.php';
?>

<section class="main-container">
  <div class = "main-wrapper">
		<?php
			require 'database.php';
		?>
			<div id="display-options">
				<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
				<span>Sort stories by:</span>
					<input type="submit" name='vieworder' value="new">
					<input type="submit" name='vieworder' value="hot">
					<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" >
					<span> <br> </span>
				</form>
			</div>
		<?php
			include 'poststory.php';
		?>
	</div>

</section>

<?php
  include_once 'footer.php';
?>
