<?php
	require_once("functions/functions1.php");
	$link = check_connection();
	if(isset($_POST['username']) && !empty($_POST['username'])) {
		$username = mysqli_real_escape_string($link, trim($_POST['username']));		
		if(isset($_POST['page']))
			$page = $_POST['page']; 
		if(isset($_POST['password']) && !empty($_POST['password'])) {
			$password = md5(mysqli_real_escape_string($link, trim($_POST['password'])));
			$sql = 'SELECT * FROM `users` WHERE `user` = "' . $username . '" AND `password` = "' . $password . '"'; 
			$pass_set = true;
		} else {			
			$sql = 'SELECT * FROM `users` WHERE `user` = "' . $username . '"'; 
			$pass_set = false;
		}	
			
		$query = mysqli_query($link, $sql);
		$num_rows = mysqli_num_rows($query);
		
		if(isset($_POST['page'])) {
			if($page == 'Log') {
				if($num_rows == 0) {
					echo 'Korisnik ne postoji.';
				}
			} else if($page == 'Reg') {
				if($num_rows !=0)
					echo 'Korisničko ime je zauzeto.';
			}
		} else {
			if($num_rows == 0) {
				if($pass_set == false)
					echo 'Korisnik ne postoji.';
				else if($pass_set == true)
					echo 'Uneta lozinka ne odgovara korisničkom imenu.';
			}
		}	
	} else {
		echo 'Došlo je do greške';
	}
?>