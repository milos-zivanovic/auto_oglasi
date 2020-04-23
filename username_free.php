<?php
	if(isset($_POST['username']) && !empty($_POST['username'])) {
		require_once("functions/functions1.php");
		$link = check_connection();
		$username = trim(strtolower($_POST['username']));
		
		$sql = "SELECT * FROM `users` WHERE `user` = '" . $username . "'";
		if(!$query = mysqli_query($link, $sql)) {
			die("Neuspelo izvršavanje upita.");
		}
		$num_rows = mysqli_num_rows($query);
		if($num_rows != 0) {
			echo 'Korisničko ime je zauzeto.';
		}
		
	} else {
		echo "Došlo je do greške.";
	}
?>