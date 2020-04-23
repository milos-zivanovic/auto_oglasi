<?php
	$title = "Ažurirajte podatke";
	require_once("functions/functions1.php");
	head($title);
	include_once("includes/title.inc");
	$link = check_connection();
	
?>
			<div class="row">
<?php
				include_once("includes/navbar.inc");
?>
				<div class="col-md-6 col-sm-6 col-xs-6">
<?php
					include_once("includes/check_user.inc");
					form("Ažurirajte podatke", $link, $_SESSION['user']);
?>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>