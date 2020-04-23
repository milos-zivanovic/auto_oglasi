<?php
	$title = "Ažurirajte oglas";
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
					include("includes/check_user.inc");
					$car_id = $_GET['car_id'];
					$sql1 = "SELECT * FROM `cars1` WHERE `car_id` = '" . $car_id . "'"; 
					$query1 = mysqli_query($link, $sql1); 
					$results1 = mysqli_fetch_array($query1); 
					
					$sql2 = "SELECT * FROM `info1` WHERE `car_id` = '" . $car_id . "'"; 
					$query2 = mysqli_query($link, $sql2); 
					$results2 = mysqli_fetch_array($query2); 
					
					if(isset($_POST['submit'])) 
					{
						if(isset($_POST['mark']) && isset($_POST['model']) && isset($_POST['year'])
						&& isset($_POST['body']) && isset($_POST['price']) && isset($_POST['cm3']) && isset($_POST['fuel'])
						&& is_numeric($_POST['year']) && is_numeric($_POST['price']) && is_numeric($_POST['cm3']))
						{
							$old_car = $_POST['old_car'];
							$user_id = $_SESSION['user_id'];
							$car = trim($_POST['mark']) . " " . trim($_POST['model']);
							$year = $_POST['year'];	
							$body = $_POST['body'];
							$price = $_POST['price'];	
							$fuel = $_POST['fuel'];
							$cm3 = $_POST['cm3'];
							$description = trim($_POST['description']);
							$path = "images/" . $old_car;
							$new_path = "images/" . $car;
							if(!mkdir("images/help", 0700)) //// HELP
								die("neuspelo kreiranje direktorijuma!");
							$help = "images/help";

							if ($car != $old_car) {
								rcopy($path, $help);  ////CAR_OLD - HELP
								//Warning: rmdir(images/Bmw 320 x drive): Directory not empty in C:\xampp\htdocs\auto_oglasi\update_add.php on line 47
							
									
								rrmdir($path); //// REMOVE CAR_OLD
								
								if(!mkdir("images/$car", 0700)) //// CAR
									die("neuspelo kreiranje direktorijuma!"); 
									
								rcopy($help, $new_path); //// HELP - CAR
									
								rrmdir($help); //// REMOVE HELP
							}
								
							$sql1 = "UPDATE `cars1` SET `car`='" . $car . "',`price`='" . $price . "'
									WHERE `car_id` = '" . $car_id . "'";
							$sql2 = "UPDATE `info1` SET `year`='" . $year . "',`body`='" . $body . "',`fuel`='" . $fuel . 
										"',`cm3`='" . $cm3 . "',`description`='" . $description . "'
									WHERE  `car_id` = '" . $car_id . "'";
							$query1 = mysqli_query($link, $sql1);
							$query2 = mysqli_query($link, $sql2);
							if(!$query1 || !$query2)
								echo "<div class='alert alert-danger' role='alert'>
									Neki od podataka nije unešen.<br/>Molimo Vas 
									<a href='add_ad.php'>pokušajte ponovo</a>.
								</div>";
							else echo '	<div class="alert alert-success" role="alert"> 
											Uspešno ste ažurirali oglas. Da bi ste pogledali listu Vaših oglasa, kliknite 
										<a href="my_ads.php">ovde</a>.
										</div>';
						}
						else 
						{
							echo "<div class='alert alert-danger' role='alert'>
									Neki od podataka nije unešen.<br/>Molimo Vas 
									da popunite sva polja.
								</div>";
							form_add_ad("Ažurirajte Vaš oglas", $results1, $results2,  true);
						}
					}
					else
						form_add_ad("Ažurirajte Vaš oglas", $results1, $results2,  true);
?>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>