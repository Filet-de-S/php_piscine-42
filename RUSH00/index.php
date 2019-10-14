<?php 

include('install.php');
session_start();
print_r($_COOKIE);

?>
<!DOCTYPE html>
	<html>
		<head>
			<metacharset = "UTF = 8" />
			<title>21 SHOP</title>
			<link rel="stylesheet" type="text/css" href="index.css">
		</head>
		<body  bgcolor = "black" style="margin: 0;" link = "black">
			<div class = "main">
				<a href = "basket.php"><img class = "login" src="resources/basket.png" /></a>
				<?php
				if ($_SESSION[loggued_on_user] == NULL)
					echo '<a href = "/login.php"><img class = "bask" src="resources/login.png" /></a>';
				else
				{
					echo '<a href = "/logout.php"><img class = "bask" src="resources/login.png" /></a>';
				}
				?>
				<a href = "index.php"><img class = "header_image" src="resources/21_shop.png" /></a>
				<br /><br /><br /><br /><br /><hr /><br /><br />
				<div class = "menu">
				<a href = "branch.php"><div class = "punkt" >BRANCH</div>
					<a href = "tier.php"><div class = "punkt" >TIER</div>
					<a href = "combo.php"><div class = "punkt" >COMBO</div></a>
					<a href = "others.php"><div class = "punkt" >OTHERS</div></a>
				</div>
				<br /><br /><br /><br /><br /><br />
				<div class = "face">
					<?php require('printmain.php'); ?>
				</div>
				<br /><br /><br /><br /><br /><hr />
				<div class = "names">© kkatelyn dshirl 2019</div>
			</div>
		</body>
	</html>