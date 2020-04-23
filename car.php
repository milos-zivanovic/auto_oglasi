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
					include("includes/check_user.inc");
					$car_id = $_REQUEST['car_id'];
					$user_id = $_SESSION['user_id'];
					$sql1 = "SELECT * FROM `cars1` WHERE `car_id` = '" . $car_id . "'"; 
					$query1 = mysqli_query($link, $sql1); 
					$results1 = mysqli_fetch_array($query1); 
					
					$sql2 = "SELECT * FROM `info1` WHERE `car_id` = '" . $car_id . "'"; 
					$query2 = mysqli_query($link, $sql2); 
					$results2 = mysqli_fetch_array($query2); 
					
					$sql3 = "UPDATE `cars1` SET `views`='" . ($results1[3]+1) . "' WHERE `car_id` = '" . $car_id . "'";
					$query3 = mysqli_query($link, $sql3); 
					$folder = $results1[1]; 
					
					echo '<div class="oglasi">';
?>
						<a id="picture" href="gallery.php?folder=<?=$folder?>" target="_blank">
							<img src="images/<?=$folder?>/slika1.jpg" alt="Slika automobila" height="auto" width="100%"/>
						</a>
<?php
						if($results1[4] == $user_id)
							echo "	<a href='delete_add.php?car_id=$car_id&dir=$folder'>Obriši oglas</a><br/>
									<a href='update_add.php?car_id=" . $car_id . "'>Uredi oglas</a><br/>
									<a href='add_photos.php?car=$folder'>Dodaj fotografije</a>";
						echo "<div class='data'>";
							echo "<h3><b>" . $results1[1] . "</b></h3><br/><h5>Cena: <b>" . $results1[2] . " €</b><br/>God.proz.: <b>" . $results2[1] . ".</b><br/>Tip: <b>" . $results2[2] . "</b><br/>Gorivo: <b>" .
									$results2[3] . "</b><br/>cm3: <b>" . $results2[4] . " cm3</b><br/>Opis: " . $results2[5] . "</h5>"; 
							include_once("includes/like_unlike.inc");
							$sql6 = "SELECT * FROM `likes` WHERE `car_id` = '" . $car_id . "'";
							$query6 = mysqli_query($link, $sql6);
							$likes = mysqli_num_rows($query6);
							echo "<b>" . $likes . "</b> osoba voli ovo.";
							echo "<br/>Oglas pregledan <b>" . $results1[3] . "</b> puta";
					echo "</div></div>";
					
					if(isset($_GET['like']) && $_GET['like']==true && isset($_GET['comment_id']) && is_numeric($_GET['comment_id']))
						like($link,$_GET['comment_id']);
					if(isset($_GET['unlike']) && $_GET['unlike']==true && isset($_GET['comment_id']) && is_numeric($_GET['comment_id']))
						unlike($link, $_GET['comment_id']);
					
					if(isset($_POST['comment_submit']) && isset($_POST['comment']) && !empty($_POST['comment']))
						add_comment($link, $car_id, mysqli_real_escape_string($link, trim($_POST['comment'])), $user_id);
						
					comment_box($link, $car_id, $user_id);
?>

				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>