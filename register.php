<?php
	$title = "Registrujte se";
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
						$retype_password = md5(mysqli_real_escape_string($link, trim($_POST['retype_password'])));
						if(empty($user) || empty($password) || empty($retype_password))
							echo "<div class='alert alert-danger' role='alert'>Molimo Vas da unesete sve podatke u 
									  <a href='register.php' class='alert-link'>formu</a> za registraciju.
									</div>";
						else if(strlen($user)<5 || strlen($user)>40 || strlen($user)<5 || strlen($password)>40)
							echo "<div class='alert alert-danger' role='alert'>Uneti podaci moraju biti odgovarajuće dužine 
									(od 5 do 40).<br/> 
									  <a href='register.php' class='alert-link'>Forma</a> za registraciju.
									</div>";
						else
						{
							if((strcmp($password, $retype_password)) == 0)
							{ //iste
								$sql = "INSERT INTO `users`(`user`, `password`) 
										VALUES('" . $user . "', '" . $password . "')";
								insert_user($link, $sql);
							}
							else echo "<div class='alert alert-danger' role='alert'>Lozinke nisu iste ili nisu unete. 
										  <a href='register.php' class='alert-link'>Pokušajte ponovo</a>.
										</div>";
						}
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