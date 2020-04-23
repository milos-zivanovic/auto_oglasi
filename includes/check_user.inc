<?php
	if(!isset($_SESSION['user']) && empty($_SESSION['user']))
		die('<div class="alert alert-danger" role="alert">Nemate pristup ovoj stranici. Niste ulogovani
				ili je sesija istekla.
				  Kliknite <a href="index.php" class="alert-link">ovde</a> da se ulogujete.
				</div>');
?>