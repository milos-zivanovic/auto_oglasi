<?php
	$title = "Moji oglasi";
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
					if(isset($_GET['process']))
					{
						$process = $_GET["process"];
						if($process == 'false')
							echo "<div class='alert alert-danger' role='alert'>Došlo je do greške prilikom brisanja Vašeg oglasa<br/>Vaše oglase možete pogledati <a href='my_ads.php'>ovde</a>.</div>";
						else if($process == 'true')
							echo "<div class='alert alert-success' role='alert'>Vaš oglas je uspešno obrisan. Vaše oglase možete pogledati <a href='my_ads.php'>ovde</a>.</div>";
					}
					else 
					{
						echo '<div class="oglasi">';
						$sql = "SELECT `car_id`, `car`, `price`, `user_id` FROM `cars1` WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
						$query = mysqli_query($link, $sql);
						$ctr = 0;
						while(($results = mysqli_fetch_array($query)) != false)
						{
							echo "<div class='oglas'>";
?>
										<a href="car.php?car_id=<?=$results[0]?>">
										<img src="images/<?=$results[1]?>/slika1.jpg" alt="Slika automobila" height="110" width="150">
<?php
										echo "<b>" . $results[1] . "</b></a><br/>" . $results[2] . " €";
								echo "</div>"; $ctr++;
						}
						if($ctr == 0)
							echo "<div class='alert alert-info' role='alert'>Nijedan Vaš oglas nije aktivan.
									  <a href='add_ad.php' class='alert-link'>Dodajte oglas</a>.
									</div>";
						echo "</div>";
					}
?>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>