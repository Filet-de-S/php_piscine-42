<?php
session_start();
?>

<!DOCTYPE html>
	<html>
		<head>
			<metacharset = "UTF = 8" />
			<title>21 SHOP</title>
			<link rel="stylesheet" type="text/css" href="index.css">
		</head>
		<body bgcolor = "black" style="margin: 0;" link = "black">
				<a href = "basket.html"><img class = "login" src="resources/basket.png" /></a>
				<a href = "login.html"><img class = "bask" src="resources/login.png" /></a>
				<a href = "index.html"><img class = "header_image" src="resources/21_shop.png" /></a>
				<br /><br /><br /><br /><br /><hr /><br /><br />
				<div class = "menu">
				<a href = "branch.php"><div class = "punkt" >BRANCH</div>
					<a href = "tier.php"><div class = "punkt" >TIER</div>
					<a href = "combo.php"><div class = "punkt" >COMBO</div></a>
					<a href = "others.php"><div class = "punkt" >OTHERS</div></a>
				</div>
				<div class = "icon">
						<?php

						$link = mysqli_connect('127.0.0.1', 'user', 'user', 'shop');
						if (($que = mysqli_query($link, "SELECT `name`, price FROM products WHERE branch = 'graph';")) === FALSE)
							echo "ERROR DURING QUERYING IMAGES";
						$row = mysqli_fetch_all($que, MYSQLI_ASSOC);
						foreach ($row as $v):?>
							<div class = "branch">
								<img class = "icon" src="resources/<?=$v[name]?>.jpg"/>
								<form action="/addtobasket.php" method="post">
							<input type="hidden" name="tovar" value="<?=$v[name]?>"/>
							<h3><?=$v[price]?></h3>
							<input type="submit" name="submit" value="Add to basket"/>
							</div>
						<?php endforeach; ?>
					</div>
			</body>
		</html>