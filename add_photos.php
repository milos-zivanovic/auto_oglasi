<?php
	$title = "Dodajte slike";
	require_once("functions/functions1.php");
	head($title);
	include_once("includes/title.inc");
	$link = check_connection();
?>
			<div class="row">
<?php
				include_once("includes/navbar.inc");
				$car = $_REQUEST['car']; 
				$num_folder_content = num_folder_contents($car);
				if(isset($_POST['submit'])) {
					$car = $_POST['car'];
					$num_photos = $_POST['num_photos'];
					add_picture($car, $title, $num_photos);				
				}
				$num_photos = 0;	
?>
				 <div class="col-md-6 col-sm-6 col-xs-6">
					<h3>Dodajte slike</h3>
<?php
					for($i=1; $i<=$num_folder_content; $i++) {
?>
						<div class="col-md-6 col-sm-6 col-xs-12 thumb">
							<a class="thumbnail" href="#">
								<img class="img-responsive" src="images/<?=$car?>/slika<?=$i?>.jpg" alt="">
							</a>
						</div>
<?php 	
						$num_photos++;
					} 
?>
					<div class='d1'>
					<form class="well-span" action="" method="post" enctype="multipart/form-data">
						<input type="file" name="file" id="file"/><br/>
						<input type="hidden" name="car" value="<?=$car?>">
						<input type="hidden" name="num_photos" value="<?=($num_photos+1)?>">
						<input type="submit" id="submit" class="btn btn-primary" name="submit" value="Dodaj" disabled>
					</form>
					</div>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
<?php
	footer($title);
?>