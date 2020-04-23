<?php
	$title = "Galerija";
	require_once("functions/functions1.php");
	head($title);
	include_once("includes/title.inc");
	$link = check_connection();
?>
			<div class="row">
<?php
				include_once("includes/navbar.inc");
				$folder = $_GET["folder"];
				$num_folder_content = num_folder_contents($folder);
?>
				 <div class="col-md-6 col-sm-6 col-xs-6">
					<div class="row carousel-holder">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
<?php
								for($i=1; $i<$num_folder_content; $i++) {
?>
									<li data-target="#carousel-example-generic" data-slide-to="<?=$i?>"></li>
<?php } ?>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="images/<?=$folder?>/slika1.jpg" alt="">
                                </div>
<?php
								for($i=2; $i<=$num_folder_content; $i++) {
?>
									<div class="item">
										<img class="slide-image" src="images/<?=$folder?>/slika<?=$i?>.jpg" alt="" height="100%" width="100%">
									</div>
<?php } ?>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
					</div>
				 </div>
				
				<div class="col-md-3 col-sm-3 hidden-xs">
					<?php banners (); ?>
				</div>
			</div>
			

<?php
	footer($title);
?>