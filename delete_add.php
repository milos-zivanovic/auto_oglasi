<?php
	$title = "Obrisati oglas";
	require_once("functions/functions1.php");
	head($title);
	$link = check_connection();
	include("includes/check_user.inc");
	if(isset($_GET['car_id']) && !empty($_GET['car_id']) && is_numeric($_GET['car_id'])) {
		$car_id = $_GET['car_id'];
		$user = $_SESSION['user'];
		$dir = $_GET['dir'];
		if(delete_add($link, $car_id, $user, $dir) == false)
			header("Location: my_ads.php?process=false");
		else header("Location: my_ads.php?process=true");
	}
?>