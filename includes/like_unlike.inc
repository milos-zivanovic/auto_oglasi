<?php
if(isset($_POST['Like']))
{
	$sql5 = "INSERT INTO `likes`(`user_id`, `car_id`) VALUES ('" . $user_id . "', '" . $car_id . "')";
	$query5 = mysqli_query($link, $sql5);
}
else if(isset($_POST['Unlike']))
{
	$sql5 = "DELETE FROM `likes` WHERE  `user_id` = '" . $user_id . "' AND `car_id` = '" . $car_id . "'";
	$query5 = mysqli_query($link, $sql5);
}
$sql4 = "SELECT * FROM `likes` WHERE `user_id` = '" . $user_id . "' AND `car_id` = '" . $car_id . "'";
$query4 = mysqli_query($link, $sql4); 
if((mysqli_num_rows($query4)) == 0)
	form_like_unlike("Like", $car_id);
else
	form_like_unlike("Unlike", $car_id);
?>