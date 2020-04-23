<?php
	$title = "Kontaktirajte nas";
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
					$name = trim($_POST['name']);
					$surname = trim($_POST['surname']);
					$email = trim($_POST['email_address']);
					$phone = trim($_POST['phone']);
					$message = $_POST['message'];
					
					if(!empty($name) && !empty($email) && !empty($message))
					{
						$to = 'z.milos93@yahoo.com';
						$subject = 'Nova poruka člana sa sajta Auto-oglasi';
						$headers = 'Od: ' . $name . '(' . $email . ')' . "/r\n" . 
									'Replay-To: ' . $email;
						if(mail($to, $subject, $message, $headers))
							echo "<div class='alert alert-succes' role='alert'>Vaša poruka je uspešno poslata.<br/>Odgovorićemo Vam u najkraćem mogućem roku!</div>";
						else 
						{
							echo '<div class="alert alert-danger" role="alert">Došlo je do greške. Molimo Vas pokušajte ponovo.</div>';
							contact_us_form();
						}
					}
					else
					{
						echo '<div class="alert alert-danger" role="alert">Polja označena * moraju biti popunjena. Molimo Vas pokušajte ponovo.</div>';
						contact_us_form();
					}
				}
				else
					contact_us_form();
?>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>