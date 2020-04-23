<?php
	echo '	<div class="col-md-3 col-sm-3 col-xs-6">
			<div class="nav1">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="cars.php">Automobili</a></li>
					<li><a href="my_ads.php">Moji oglasi</a></li>
					<li><a href="add_ad.php">Dodajte oglas</a></li>
					<li><a href="contact_us.php">Kontaktirajte nas</a></li>';
					if(isset($_SESSION['user']))
					{
						echo '<li><a href="logout.php">Odjavite se</a></li>';	
					} else {
						echo '<li><a href="index.php">Ulogujte se</a></li>';
					}
	echo '			</ul>
			</div>';
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {	
	echo		'<div class="pretraga">
				<h3><b>Pretraga</b></h3>';
				search_form();
	echo		'</div>';
	}
	echo'	</div>';
?>