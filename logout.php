<?php
	session_start();
	if(isset($_SESSION['user']))
		session_destroy();
		
	unset($_COOKIE['user']);
	setcookie('user', null, time() - 1);
	unset($_COOKIE['password']);
	setcookie('password', null, time() - 1);
	unset($_COOKIE['user_id']);
	setcookie('user_id', null, time() - 1);
	
	header("Location: index.php");
?>