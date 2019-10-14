<?php
session_start();

$log = $_POST[login];
$pw = $_POST[passwd];


include 'auth.php';
if (auth($log, $pw) === TRUE) {
    $_SESSION[loggued_on_user] = $log;
    header('Location: /index.php');
} else { $_SESSION[loggued_on_user] = "";
header('refresh: 2sec; url=/signin.php');
echo "not logged in\n"; }

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
				<a href = "login.php"><img class = "bask" src="resources/login.png" /></a>
				<a href = "index.php"><img class = "header_image" src="resources/21_shop.png" /></a>
				<br /><br /><br /><br /><br /><hr /><br /><br />
				<div class = "menu">
					<div class = "punkt" >BRANCH</div>
					<div class = "punkt" >TIER</div>
					<a href = "combo.html"><div class = "punkt" >COMBO</div></a>
					<a href = "others.html"><div class = "punkt" >OTHERS</div></a>
				</div>
			<br /><br /><br /><br /><br /><br /><br /><br />
			<div class="main">

			<form action="/signin.php" method="post">
				<div class = "log"> Username:<input type = "text" name = "login" placeholder = "Your logo" value = ""></div>
				<br />
				<div class = "log">Password:<input type = "password" name = "passwd" placeholder = "Your passwd" value = ""></div>
				<br /><br /><br /><br />
				<div class = "but"><input type = "submit" name = "submit" value = "OK"></div>
			</form>

			</div>
		</body>
	</html>