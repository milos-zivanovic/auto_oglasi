<?php
if(isset($_POST['username']) && !empty($_POST['username'])  &&  isset($_POST['password']) &&
    !empty($_POST['password'])  &&  isset($_POST['repeat_password']) && !empty($_POST['repeat_password'])) {

    session_start();
    $session_user_id = $_SESSION['user_id'];
    require_once("functions/functions1.php");
    $link = check_connection();

    $username = htmlentities (trim ($_POST['username']));
    $password = htmlentities ($_POST['password']);
    $repeat_password = htmlentities ($_POST['repeat_password']);

    $username = mysqli_real_escape_string ($link, $username);
    $password = mysqli_real_escape_string ($link, $password);
    $password = md5($password);
    $repeat_password = mysqli_real_escape_string ($link, $repeat_password);


    $sql = 'UPDATE `users` SET `user`="' . $username . '",`password`="' . $password . '" 
				WHERE `user_id` = "' . $session_user_id . '"';
    if($query = mysqli_query($link, $sql)) {
        if(mysqli_affected_rows ($link) == 0) {
            echo "Podaci su isti kao dosadašnji.";
        } else {
            echo "Podaci uspešno ažurirani.";
        }
    } else {
        echo("Korisničko ime već postoji ili je došlo do greške.");
    }

}else {
    echo "Došlo je do greške.";
}
?>