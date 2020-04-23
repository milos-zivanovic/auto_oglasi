<?php
	function head($title)
	{
		session_start();
?>
		<!DOCTYPE html>
		<html lang="sr">
			<head>
				<meta charset="UTF-8">
				<title><?=$title?></title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
				<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
			</head>
			<body>
				<div class="container">
<?php
	}
	function footer($title)
	{
?>			<div class="row footer">
				<div class="col-md-12">
					<a href="cars.php">Automobili</a>
					<a href="my_ads.php" style="margin-left:5em">Moji oglasi</a>
					<a href="add_ad.php" style="margin-left:5em">Dodajte oglas</a>
					<a href="contact_us.php" style="margin-left:5em">Kontaktirajte nas</a>
<?php
					if(isset($_SESSION['user']))
						echo '<a href="logout.php" style="margin-left:5em">Odjavite se</a>';
		echo '	</div>
			</div>';
		echo "		</div>
					<script src='bootstrap/js/jquery.js'></script>
					<script src='bootstrap/js/bootstrap.min.js'></script>";
			
		switch($title) {
			case 'Ulogujte se':
				echo "<script type='text/javascript' src='bootstrap/js/jquery_ext.js'></script>";
				break;
			case 'Registrujte se':
				echo "<script type='text/javascript' src='bootstrap/js/jquery_ext.js'></script>";
				break;
			case 'Dodajte slike':
				echo "<script type='text/javascript' src='bootstrap/js/add_photo_fadeTo.js'></script>";
				break;
			case 'Ažurirajte podatke':
				echo '<script type="text/javascript" src="bootstrap/js/update.js"></script>';
				break;
			case 'Automobili':
				echo '<script type="text/javascript" src="bootstrap/js/car.js"></script>';
				break;
		}	
		echo "	</body>
			</html>";	
	}
	
	function check_connection()
	{
		$link = mysqli_connect("localhost", "root", "", "cars");
		if(!$link)
			die("Neuspela konekcija na bazu.");
		return $link;
	}
	
	function form($title, $link, $user)
	{
		if($title == 'Ulogujte se' || $title == 'Registrujte se')
		{
?>
			<form action="" method="post" id="form1">
				<h3 style="text-align: left; margin-top: 0px "> <?=$title?> </h3>
<?php
				if($title == 'Ulogujte se') 
					echo '<input id="username" type="text" name="username" class="text" placeholder="Unesite ime..." maxlength="40" autofocus/>';
				else if($title == 'Registrujte se')
					echo '<input id="username_reg" type="text" name="username" class="text" placeholder="Unesite ime..." maxlength="40" autofocus/>';
?>
				<span id="username_feedback"></span>
				<input id="password" type="password" name="password" class="text" placeholder="Unesite lozinku..." maxlength="40" />	
				<span id="password_feedback"></span>
				<br/><br/>
				
<?php
			if($title == 'Ulogujte se') {
				echo '<input type="hidden" id="hidden" value="false" name="retype_password">';
				echo '<div id="remember"><input type="checkbox" class="checkbox" name="checkbox" id= "checkbox"style="display:inline;margin-bottom:20px;"/> Zapamti podatke</div>';
			}
		}
		if($title == 'Registrujte se')
		{
			echo '<input type="hidden" id="hidden" value="true" name="retype_password">';
		}
		if($title == "Ažurirajte podatke")
		{
			$sql = 'SELECT `user` FROM `users` WHERE `user_id` = "' . $_SESSION['user_id'] . '"';
			$query = mysqli_query($link, $sql);
			$result = mysqli_fetch_array($query);
?>
				<input class="text" type="text" name="username" id="username" value="<?=$user?>">
				<span id="username_feedback"></span><br/>
				<input class="text" type="password" name="password" id="password" placeholder="Nova lozinka...">
				<span id="password_feedback"></span><br/>
				<input class="text" type="password" name="retype_password" id="retype_password" placeholder="Ponovi novu lozinku...">
				<span id="retype_password_feedback"></span><br/>
<?php
		
		echo '	<span id="update_status"></span>';
		}
		echo '<input class="dugme_submit" type="submit" name="button_submit" id="button_submit" value="'. $title .'" disabled="true">';
	}
	
	function check_user($link1, $sql1)
	{
		$results = mysqli_query($link1, $sql1);
		$result = mysqli_fetch_array($results);
		if(mysqli_num_rows($results) == 0)
		{
			die("<div class='alert alert-danger' role='alert'>Netačna kombinacija korisničkog imena
					i lozinke.
					  <a href='index.php' class='alert-link'>Ulogujte se</a> <br/>Molimo Vas pokušajte ponovo.
					</div>");
		}
		return $result;
	}	
	
	
	function insert_user($link, $sql)
	{
		$results = mysqli_query($link, $sql);
		$ctr = 0;
		if(!$results) 
		{
			echo '<div class="alert alert-danger" role="alert">Korisnik sa tim imenom već postoji.
				  Kliknite <a href="register.php" class="alert-link">ovde</a> da pokušate ponovo.
				</div>';
			$ctr = 1;
		}
		if($ctr ==0)
		{
			if(mysqli_affected_rows($link) == 0)
				echo '<div class="alert alert-danger" role="alert">Došlo je do greške prilikom registracije.
					  Kliknite <a href="register.php" class="alert-link">ovde</a> da pokušate ponovo.
					</div>';
			else echo '<div class="alert alert-success" role="alert"> Uspešno ste se registrovali.
						  <a href="index.php" class="alert-link">Ulogujte se</a>.
						</div>';	
		}						
	}
	
		function form_add_ad($title, $results1, $results2,  $ctr)
	{
		$model_list = array("Alfa Romeo", "Audi", "Bmw", "Citroen", "Fiat", "Mercedes", 
						"Opel", "Peugeot", "Renault", "Volkswagen", "Zastava");
		$body = array("Limuzina", "Hečbek", "Karavan", "Kupe", "Kabriolet/Rodster", "Džip", "Pick up");
		$fuel = array("Benzin", "Dizel", "Benzin + Gas (TNG)", "Metan CNG", "Električni pogon", "Hibridni pogon");
		if($ctr == true)
		{
			$car = explode(" ", $results1[1]);  
			$mark = $car[0]; // Opel
			$model = "";
			for($i=1; $i<(count($car)); $i++)
				$model .= $car[$i] . " ";
			$model= trim($model); 
			$year = $results2[1];
			$body_new = $results2[2];
			$fuel_new = $results2[3];
		}
		echo '<h3 style="text-align: center;">' . $title . '</h3>';
		echo '<form action="" method="post" enctype="multipart/form-data">
					<label>Marka *</label>
					<select name="mark" class="form-control" id="sel1">';
						for($i=0; $i<count($model_list); $i++)
						{
							if($ctr == true)
							{
								if(strcmp($model_list[$i], $mark) == 0)
									echo "<option value='" . $model_list[$i] . "' selected>" . $model_list[$i] . "</option>";
								else echo "<option value='" . $model_list[$i] . "'>" . $model_list[$i] . "</option>";
							}
							else echo "<option value='" . $model_list[$i] . "'>" . $model_list[$i] . "</option>";
						}
		echo			'</select><br/>
					<label>Model *</label><br/>
					<input type="text" name="model" ';
					if($ctr == true)
					{
						echo 'value="' . $model . '"';
					}
					else
						echo 'placeholder="Model..."';
		echo		'><br/><br/>
					<label>Godina proizvodnje *</label><br/>
					<select name="year" class="form-control" id="sel1">';
						$current_year =  date("Y");
						for($i=$current_year; $i>=1960; $i--)
						{
							if($ctr == true)
							{
								if($i == $year)
									echo "<option value='" . $i . "' selected>" . $i . "</option>";
								else echo "<option value='" . $i . "'0>" . $i . "</option>";
							}
							else echo "<option value='" . $i . "'0>" . $i . "</option>";
						}
		echo		'</select><br/>
					<label>Karoserija *</label><br/>
					<select name="body" class="form-control" id="sel1">';
						for($i=0; $i<count($body); $i++)
						{
							if($ctr == true)
							{
								if(strcmp($body[$i], $body_new) == 0)
									echo "<option value='" . $body[$i] . "' selected>" . $body[$i] . "</option>";
								else echo "<option value='" . $body[$i] . "'>" . $body[$i] . "</option>";
							}
							else echo "<option value='" . $body[$i] . "'>" . $body[$i] . "</option>";
						}
		echo        '</select><br/>
					<label>Cena *</label><br/>
					<input type="number" name="price"';
					if($ctr == true)
						echo 'value="' . $results1[2] . '"';
					else
						echo 'placeholder="5000€"';
		echo		'><br/><br/>
					<label>Kubikaža *</label><br/>
					<input type="number" name="cm3"';
					if($ctr == true)
						echo 'value="' . $results2[4] . '"';
					else
						echo'placeholder="2000cm3"';
		echo		'><br/><br/>
					<label>Gorivo *</label><br/>
					<select name="fuel" class="form-control" id="sel1">';
						for($i=0; $i<count($body); $i++)
						{
							if($ctr == true)
							{
								if(strcmp($fuel[$i], $fuel_new) == 0)
									echo "<option value='" . $fuel[$i] . "' selected>" . $fuel[$i] . "</option>";
								else echo "<option value='" . $fuel[$i] . "'>" . $fuel[$i] . "</option>";
							}
							else echo "<option value='" . $fuel[$i] . "'>" . $fuel[$i] . "</option>";
						}
		echo		'</select><br/>';
					if($ctr == false)
						echo'<label>Dodajte sliku (jpg, png, gif) * </label><br/>
							<input type="file" name="file"/><br/><br/>';
		echo		'<label>Opis</label><br/>
					<div style="width:100%;">
					 <textarea style="width:100%; display: inline-block;" rows="5" name="description">';
					if($ctr == true)
						echo $results2[5];	
		echo		'</textarea></div><br/>	
					<input type="hidden" name="old_car" value="' . $results1[1] . '">
				<input type="reset" class="btn btn-danger" name="reset" value="Obriši"/>
				<input type="submit" class="btn btn-primary" name="submit" '; 
				if($ctr == true)
					echo "value='Ažuriraj'"; 
				else echo "value='Dodaj'";
		echo'/></form>';
	}
				
    function add_picture($car, $page, $number)
	{
		$allowedExts = array("gif", "jpg", "png", "jpeg");
		$temp = explode(".", $_FILES["file"]["name"]); 
		$extension = end($temp);
		if(strcmp($page, "Dodajte slike") == 0)
			$target_dir = "images/" . $car . "/slika$number.$extension";	
		else
			$target_dir = "images/" . $car . "/slika1.$extension";

		if (
            (
                $_FILES["file"]["type"] == "image/gif" || $_FILES["file"]["type"] == "image/jpg"
                || $_FILES["file"]["type"] == "image/png" || $_FILES["file"]["type"] == "image/jpeg"
            )
            && $_FILES["file"]["size"] < 5000000
			&& in_array($extension, $allowedExts)
        ) {
			if ($_FILES["file"]["error"] > 0) 
				echo "Error: " . $_FILES["file"]["error"] . "<br>";  
			else 
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir);
			if(strcmp($page, "Dodajte slike") == 0)
				header("Location: add_photos.php?car=$car");
		} 
		else {
			echo "Nevalidna datoteka";
			die();
        }
	}
	
	function form_like_unlike($btn, $car_id)
	{
?>
		<form action="" method="post" style="display: inline-block; margin: 10px 5px 5px 0px;">
			<input type="submit" name="<?=$btn?>" value="<?=$btn?>" class="btn btn-primary">
			<input type="hidden" name="car_id" value=" <?=$car_id?> ">
		</form>
<?php
	}
	
	function num_folder_contents($folder) {
		$num_folder_content = 0; 
		$dir = 'images/'.$folder;
		if ($handle = opendir($dir)) {
			while (($file = readdir($handle)) !== false){
				if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
					$num_folder_content++;
			}
		}
		return $num_folder_content;
	}
	
	function rrmdir($dir) {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") rrmdir("$dir/$file");
            rmdir($dir);
        }
        else if (file_exists($dir)) unlink($dir);
    }
	
	 function rcopy($src, $dst) {
        if (file_exists ( $dst ))
            rrmdir ( $dst );
        if (is_dir ( $src )) {
            mkdir ( $dst );
            $files = scandir ( $src );
            foreach ( $files as $file )
                if ($file != "." && $file != "..")
                    rcopy ( "$src/$file", "$dst/$file" );
        } else if (file_exists ( $src ))
            copy ( $src, $dst );
    }
	
	function search_form()
	{
		$model_list = array("Alfa Romeo", "Audi", "Bmw", "Citroen", "Fiat", "Mercedes", 
						"Opel", "Peugeot", "Renault", "Volkswagen", "Zastava");
		$body = array("Limuzina", "Hečbek", "Karavan", "Kupe", "Kabriolet/Rodster", "Džip", "Pick up");
		$fuel = array("Benzin", "Dizel", "Benzin + Gas (TNG)", "Metan CNG", "Električni pogon", "Hibridni pogon");
		echo'<form action="search.php" method="post">
				<label>Marka</label><br/>
				<select name="mark" class="form-control" id="sel1">
				<option =""></option>';
				for($i=0; $i<(count($model_list)); $i++)
					echo '<option value="' . $model_list[$i] . '">' . $model_list[$i] . '</option>';
?>
				</select><br/>
				<label>Model</label><br/>
				<input type="text" name="model"  class="input"><br/><br/>
				<label>Cena</label><br/>
				<input type="number" name="from_price" placeholder="od" class="input"><br/>
				<input type="number" name="to_price" placeholder="do" class="input"><br/><br/>
				<label>Godina proizvodnje</label><br/>
				<input type="number" name="from_year" placeholder="od" class="input"><br/>
				<input type="number" name="to_year" placeholder="do" class="input"><br/><br/>
				<label>Karoserija</label><br/>
				<select name="body" class="form-control" id="sel1">
				<option =""></option>
<?php
				for($i=0; $i<(count($body)); $i++)
					echo '<option value="' . $body[$i] . '">' . $body[$i] . '</option>';
		echo 	'</select><br/>
				<label>Gorivo</label><br/>
				<select name="fuel" class="form-control" id="sel1">
				<option =""></option>';
				for($i=0; $i<(count($fuel)); $i++)
					echo '<option value="' . $fuel[$i] . '">' . $fuel[$i] . '</option>';
		echo 	'</select><br/><br/>
				<input type="submit" namme="search_btn" value="Pretraga" class="btn btn-primary">';
		echo	'</form>';
	}
	
	function comment_box($link, $car_id, $user_id)
	{
		$sql = "SELECT * FROM `comments`, `users`, `likes_unlikes_comment`
				WHERE `car_id` = '" . $car_id . "' AND comments.comment_id = likes_unlikes_comment.comment_id AND users.user_id = comments.user_id 
				ORDER BY `date_time`  DESC LIMIT 5"; 
		$query = mysqli_query($link, $sql);
		$num_rows = mysqli_num_rows($query); 
		echo '<div class="detailBox">
				<div class="titleBox">
				  <label>Komentari</label>
				</div>
				<div class="actionBox">
					<ul class="commentList">';
		if($num_rows == 0)
			echo "Nema komentara o vozilu";
		else 
		{ 
			while(($rows = mysqli_fetch_array($query)) == true)
			{
				$date_time = explode(" ", $rows[4]);
				$date = $date_time[0];
				$time = $date_time[1];
				echo			'<li>
									<div class="commentText">
										<p><b>' . $rows['user'] . '</b></p>
										<p class="">' . $rows['comment'] . '</p> <span class="date sub-text"><b>on</b> ' . $date . ' <b>at</b> ' . $time . '</span>
										<p>
											<span class="date sub-text"><b>' . $rows['num_likes_comment'] . "</b> ";
											echo "<a href='car.php?like=true&car_id=" . $car_id . "&user_id=" . $user_id . "&comment_id=" . $rows['comment_id'] . "'><img src='images/like_comment.png' width='15px' height='15px'></a>";
											echo " <b>" . $rows['num_unlikes_comment'] . "</b> ";
											echo "<a href='car.php?unlike=true&car_id=" . $car_id . "&user_id=" . $user_id . "&comment_id=" . $rows['comment_id'] . "'><img src='images/unlike_comment.png' width='15px' height='15px'></a>";
											echo '</span>
										</p>
									</div>
								</li><br/>'; 
								
			}
		}
?>
				</ul>
					<form class="form-inline" role="form" action="" method="post">
						<div class="form-group">
							<input class="form-control" type="text" name="comment" placeholder="Vaš komentar..." />
						</div>
						<div class="form-group">
							<input type="submit" name="comment_submit" value="Dodaj" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
<?php
	}
	
	function add_comment($link, $car_id, $comment, $user_id)
	{
		$date = date('Y-m-d');
		$time = date('H:i:s');
		$date_time = $date . " " . $time;
		$sql = 'INSERT INTO `comments`(`user_id`, `car_id`, `comment`, `date_time`)
				VALUES ("' . $user_id . '", "' . $car_id . '", "' . $comment . '", "' . $date_time . '")';
		$query = mysqli_query($link, $sql);
		$sql1 = "INSERT INTO `likes_unlikes_comment`(`num_likes_comment`, `num_unlikes_comment`) 
				VALUES ('0', '0')"; 
		$query1 = mysqli_query($link, $sql1);
		if(mysqli_affected_rows($link) == 0)
			echo '<br/><br/><div class="alert alert-danger" role="alert">Neuspešno dodavanje komentara.</div>';
		else echo '<br/><br/><div class="alert alert-success" role="alert">Uspešno ste dodali komentar.</div>';
	}	
	
	function like($link, $comment_id)
	{
		$sql = "UPDATE `likes_unlikes_comment` SET `num_likes_comment` = (`num_likes_comment`+1) WHERE `comment_id` = '" . $comment_id . "'";
		mysqli_query($link, $sql);
	}
	
	function unlike($link, $comment_id)
	{
		$sql = "UPDATE `likes_unlikes_comment` SET `num_unlikes_comment` = (`num_unlikes_comment`+1) WHERE `comment_id` = '" . $comment_id . "'";
		mysqli_query($link, $sql);
	}
	
	function contact_us_form() {
?>
	<form class="form-horizontal" method="post">
		<fieldset>
			<legend class="text-center header">Contact us</legend>

			<div class="form-group">
				<div class="col-md-8">
					Ime: *<input id="fname" name="name" type="text" placeholder="Ime..." class="form-control" required autofocus>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8">
					Prezime:<input id="lname" name="surname" type="text" placeholder="Prezime" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-8">
					Email: *<input id="email" name="email_address" type="text" placeholder="Email adresa..." class="form-control">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-8">
					Telefon<input id="phone" name="phone" type="number" placeholder="Telefon..." class="form-control">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-8">
					Poruka: *<textarea class="form-control" style="resize: none" id="message" name="message" placeholder="Unesite Vaš komentar..." rows="7"></textarea>
				</div>
			</div>

			<div >
				<input class="dugme_submit" type="submit" name="button_submit" id="button_submit" value="Pošalji">
			</div>
		</fieldset>
	</form>
<?php
	}
	
	function delete_add($link, $car_id, $user, $dir) {
		$sql1 = "DELETE FROM `cars1` WHERE `car_id` = '" . $car_id . "'";
		$sql2 = "DELETE FROM `info1` WHERE `car_id` = '" . $car_id . "'";
		$sql3 = "DELETE FROM `likes` WHERE `car_id` = '" . $car_id . "'";
		$sql4 = "DELETE FROM `comments` WHERE `car_id` = '" . $car_id . "'";
		
		if(!mysqli_query($link, $sql1))
			echo "sql1 nije dobar";
		if(!mysqli_query($link, $sql2))
			echo "sql2 nije dobar";
		if(!mysqli_query($link, $sql3))
			echo "sql3 nije dobar";
		if(!mysqli_query($link, $sql4))
			echo "sql4 nije dobar";
		
		if(rrmdir($dir))
			echo "uspesno obrisan folder sa slikama";
		else echo "neuspesno obrisan folder sa slikama";
		
		
		if(mysqli_query($link, $sql1) && mysqli_query($link, $sql2) && mysqli_query($link, $sql3) && mysqli_query($link, $sql4))
			$query = true;
		else $query = false;
		
		if($query == true)
			return true;
		else return false;
	}
	
	function pages ($num_pages, $limitx, $limity, $page) {
		for($i=1; $i<=$num_pages; $i++) {
			echo "<a href='$page.php?limitx=$limitx&limity=$limity'>". $i ." </a>";
			$limitx = $limitx + 15;
			$limity = $limity + 15;
		}
	}
	
	function banners () {
		echo "<a href='https://www.youtube.com/' target='_blank'><img src='images/youtube-banner.jpg' width='100%' height='auto' alt='facebook_banner'/></a><br/>";
		echo "<a href='https://www.facebook.com' target='_blank'><img src='images/facebook-banner.jpg' width='100%' height='auto' alt='facebook_banner'/></a><br/>";
		echo "<a href='https://www.google.rs' target='_blank'><img src='images/google-banner.jpg' width='100%' height='auto' alt='facebook_banner'/></a><br/>";
	}
?>