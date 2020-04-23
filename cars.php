<?php
	$title = "Automobili";
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
					if(isset($_GET['limitx']) && is_numeric($_GET['limitx']))
						$limitx = $_GET['limitx'];
					else $limitx = 0;
					
					if(isset($_GET['limity']) && is_numeric($_GET['limity']))
						$limity = $_GET['limity'];
					else $limity = 15;
					
					$adds_num = 0;
					$sql1 = "SELECT `car_id` FROM `cars1`";
					$query1 = mysqli_query($link, $sql1);
					$adds_num = mysqli_num_rows($query1);
					$num_pages = ceil($adds_num / 15); 
					
					
					echo '<div class="oglasi">';
						$sql = "SELECT * FROM `cars1` LIMIT " . $limitx . ", " . $limity . ""; 
						$query = mysqli_query($link, $sql);
						while(($results = mysqli_fetch_array($query)) != false)
						{
							// stampaj div sa slikom, god, kub i cenom
							echo "<div class='oglas'>";
?>
								<a href="car.php?car_id=<?=$results[0]?>">
								<img src="images/<?=$results[1]?>/slika1.jpg" alt="Slika automobila" height="110" width="150">
<?php
								echo "<b><br/>" . $results[1] . "</b></a><br/>" . $results[2] . " €";
							echo "</div>";
						}
						?>
						</div>
						
						<div class="pages">
<?php
							pages ($num_pages, 0, 15, 'cars');
?>
						</div>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>