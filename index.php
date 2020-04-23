<?php
	$title = "Ulogujte se";
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
					if(isset($_POST['button_submit']))
					{
						$user = mysqli_real_escape_string($link, trim($_POST['username']));
						$password = md5(mysqli_real_escape_string($link, trim($_POST['password'])));
						$time = time();
						if(empty($user) || empty($password))
							echo "<div class='alert alert-danger' role='alert'>Molimo Vas da unesete oba podatka u 
									  <a href='index.php' class='alert-link'>formu</a> za logovanje.
									</div>";
						else if(strlen($user)>=5 && strlen($user)<=40 && strlen($password)<=40 && strlen($password)>=5)
						{
							$sql = "SELECT * FROM `users` WHERE `user` = '" . $user . "' AND `password` = '" . $password . "'"; 
							$results = check_user($link, $sql);
							$_SESSION['user'] = $user;
							$_SESSION['user_id'] = $results[0]; 
							if(isset($_POST['checkbox']))
							{
								$time = time();
								if((setcookie("user", $user, $time + 2678400)) && (setcookie("password", $password, $time + 2678400)) && (setcookie("user_id", $results[0], $time + 2678400))) {
									header("Location: welcome.php?kukiji=true");
								} else {
									header("Location: welcome.php?kukiji=false");
								}
							}
							header("Location: welcome.php?kukiji=false");
						}
						else echo "<div class='alert alert-danger' role='alert'>Uneti podaci moraju biti odgovarajuće dužine 
									(od 5 do 40).<br/>
									  <a href='index.php' class='alert-link'>Forma</a> za logovanje.
									</div>";
					}
					else if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) && isset($_COOKIE['password']) && !empty($_COOKIE['password']))
					{
						$_SESSION['user'] = $_COOKIE['user'];
						$_SESSION['user_id'] = $_COOKIE['user_id'];
						header("Location: welcome.php");
					}
					else
						include("includes/login_form.inc");
?>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>