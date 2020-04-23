<?php
if(!isset($_SESSION['user']) || empty($_SESSION['user']))
	form($title, $link, "");
else 
	echo $_SESSION['user'] . "(<a href='logout.php'>logout</a>)";


if(!isset($_SESSION['user']) && empty($_SESSION['user']))
	if($title == "Ulogujte se")
		echo '<span style="color: #428bca; text-decoration: none;"><a href="register.php">Registrujte se</a></span>';
	elseif($title == "Registrujte se")
		echo '<span style="color: #428bca; text-decoration: none;"><a href="index.php">Ulogujte se</a></span>';
?>