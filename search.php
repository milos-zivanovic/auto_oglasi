<?php
	$title = "Pretraga";
	require_once("functions/functions1.php");
	head($title);
	include_once("includes/title.inc");
	$link = check_connection();
?>
	<div class="row">
<?php
		include_once("includes/navbar.inc");
?>
		 <div class="col-md-6 col-sm-6 col-xs-6">
<?php
			$query_names = array("body", "fuel");
		
			if(!empty($_POST['mark']) || !empty($_POST['model']))
				$model = " AND `car` LIKE '%" . trim($_POST['mark']) . " " . trim($_POST['model']) . "%'";
			else $model = '';
			
			for($i=0; $i<(count($query_names)); $i++)
			{
				if(!empty($_POST[$query_names[$i]]))
					$query[$query_names[$i]] = ' AND `' . $query_names[$i] . '` = "' . $_POST[$query_names[$i]] . '"';
				else $query[$query_names[$i]] = '';
			}
			
			//// CENA
			if(!empty($_POST['from_price']) && !empty($_POST['to_price']))
			{
				if($_POST['from_price'] <= $_POST['to_price'] )
					$query_prices = " AND `price` BETWEEN '" . $_POST['from_price'] . "' AND '" . $_POST['to_price'] . "'";
				else { $query_prices = ''; $err_prices = true; }
			}
			else if(empty($_POST['from_price']) && !empty($_POST['to_price']))
				$query_prices = " AND `price` <= " . $_POST['to_price'];
			else if(!empty($_POST['from_price']) && empty($_POST['to_price']))
				$query_prices = " AND `price` >= " . $_POST['from_price'];
			else $query_prices = '';
			
			//// GODINA
			if(!empty($_POST['from_year']) && !empty($_POST['to_year']))
			{
				if($_POST['from_year'] <= $_POST['to_year'] )
					$query_years = " AND `year` BETWEEN '" . $_POST['from_year'] . "' AND '" . $_POST['to_year'] . "'";
				else { $query_years = ''; $err_years = true; }
			}
			else if(empty($_POST['from_year']) && !empty($_POST['to_year']))
				$query_years = " AND `year` <= " . $_POST['to_year'];
			else if(!empty($_POST['from_year']) && empty($_POST['to_year']))
				$query_years = " AND `year` >= " . $_POST['from_year'];
			else $query_years = '';
				
			if(isset($err_years) && $err_years == true && isset($err_prices) && $err_prices == true)
				echo '<div class="alert alert-danger" role="alert">Iz pretrage je isključena cena i godina proizvodnje zbog neispravnog formata.</div>';
			else if(isset($err_years) && $err_years == true)
					echo '<div class="alert alert-danger" role="alert">Iz pretrage je isključena godina proizvodnje zbog neispravnog formata.</div>';
			else if(isset($err_prices) && $err_prices == true)
					echo '<div class="alert alert-danger" role="alert">Iz pretrage je isključena cena zbog neispravnog formata.</div>';

					
			if(isset($_GET['limitx']) && is_numeric($_GET['limitx']))
				$limitx = $_GET['limitx'];
			else $limitx = 0;
			
			if(isset($_GET['limity']) && is_numeric($_GET['limity']))
				$limity = $_GET['limity'];
			else $limity = 15;
			
			$sql1 = "SELECT `car_id` FROM `cars1`";
			$query1 = mysqli_query($link, $sql1);
			$adds_num = 0;
			$adds_num = mysqli_num_rows($query1);
			$num_pages = ceil($adds_num / 15); 

			echo '<div class="oglasi">';
				$sql = "SELECT * FROM `cars1`, `info1` WHERE cars1.car_id = info1.car_id" . $model . $query['body'] . $query['fuel'] . $query_prices . $query_years . " LIMIT " . $limitx . ", " . $limity . "";
				$query = mysqli_query($link, $sql);
				
				if($adds_num != 0) {
					echo '<div class="alert alert-success" role="alert"><b>'. $adds_num .'</b> rezultata pretrage</div>';
					while(($results = mysqli_fetch_array($query)) != false)
					{
						// stampaj div sa slikom, god, kub i cenom
						echo "<div class='oglas'>";
?>
							<a href="car.php?car_id=<?=$results[0]?>">
							<img src="images/<?=$results[1]?>/slika1.jpg" alt="Slika automobila" height="110" width="150">
<?php
							echo "<b><br/>" . $results[1] . "</b></a><br/>" . $results[2] . " €";
						echo "</div>";
					}	
				}	
				else echo '<div class="alert alert-danger" role="alert">Trenutno nema rezultata koji odgovaraju Vašem kriterijumu pretraživanja.</div>';			
				
			echo '</div>';
			
			echo '<div class="pages">';
				pages ($num_pages, 0, 15, 'search');
			echo '</div>';
?>
		 </div>
		 
		<div class="col-md-3 col-sm-3 hidden-xs">
			<?php banners (); ?>
		</div>
	</div>
<?php
	footer($title);
?>