<?php
	$title = "Dodajte oglas";
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
						if(isset($_POST['submit']))
						{
							if(isset($_POST['mark']) && strlen($_POST['mark'])>2 && isset($_POST['model']) && isset($_POST['year']) &&
								is_numeric($_POST['year']) && isset($_POST['body']) && isset($_POST['price']) && is_numeric($_POST['price']) &&
								isset($_POST['fuel']) && isset($_POST['cm3']) && is_numeric($_POST['cm3']))
							{
								
								$user_id = $_SESSION['user_id'];
								$car = trim($_POST['mark']) . " " . trim($_POST['model']);
								$year = $_POST['year'];	
								$body = $_POST['body'];
								$price = $_POST['price'];	
								$fuel = $_POST['fuel'];
								$cm3 = $_POST['cm3'];
								$description = mysqli_real_escape_string($link, $_POST['description']);
								if(!mkdir("images/$car", 0700))
									die("neuspelo kreiranje direktorijuma!");
								$sql1 = "INSERT INTO `cars1`(`car`, `price`, `user_id`) 
										VALUES ('" . $car . "', '" . $price . "', '" . $user_id . "')";
								$sql2 = "INSERT INTO `info1`(`year`, `body`, `fuel`, `cm3`, `description`) 
								VALUES ('" . $year . "', '" . $body . "', '" . $fuel . "', '" . $cm3 . "', '" . $description . "')";
								$query1 = mysqli_query($link, $sql1);
								$query2 = mysqli_query($link, $sql2);
								add_picture($car, $title, 0);
								if(!$query1 || !$query2)
									echo "<div class='alert alert-danger' role='alert'>
										Neki od podataka nije unešen.<br/>Molimo Vas 
										<a href='add_ad.php'>pokušajte ponovo</a>.
									</div>";
								else header("Location: add_photos.php?car=$car");
								
							}
							else
							{
								echo "<div class='alert alert-danger' role='alert'>
										Neki od podataka nije unešen.<br/>Molimo Vas pokušajte ponovo.
									</div>";
								form_add_ad("Dodajte Vaš oglas", 0, 0,  false);
							}
						}
						else form_add_ad("Dodajte Vaš oglas", 0, 0, false);
?>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>