<?php
	$title = "Dorodošli";
	require_once("functions/functions1.php");
	head($title);
	include_once("includes/title.inc");
	$link = check_connection();
?>


			
			<div class="row">
<?php
				include_once("includes/navbar.inc");
?>
				 
				 <div class="col-md-6 col-sm-6 hidden-xs">
<?php
					include_once("includes/check_user.inc");
					$user = $_SESSION['user'];
					echo '<div class="alert alert-success" role="alert"> <h4>Dorodošli 
						<b>' . $user . '</b> (<a href="logout.php">logout</a>)
					</h4><a href="update.php">uredi podatke</a></div>';
?>
				 </div>
				
				<div class="col-md-3 col-sm-3 col-xs-6">
					<?php banners (); ?>
				</div>
				

			</div>
			
			<div class="row visible-xs">
				 <div class="visible-xs">
<?php
					include("includes/login_form.inc");
?>
				 </div>
			</div>
			
			
			
			
<?php
	footer($title);
?>