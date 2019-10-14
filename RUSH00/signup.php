<?php
session_start();

$name = $sub = $pw = $email = "";
$name = $_POST[login];
$pw = $_POST[passwd];
$sub = $_POST[submit];
$email = $_POST[email];

if ($sub == "OK" && $email !== "" && $pw !== "")
{
	$pw = hash('whirlpool', $pw);
    $link = mysqli_connect('127.0.0.1', 'user', 'user', 'shop');
	if (($que = mysqli_query($link, "INSERT INTO priv VALUES ('{$name}', 0, '{$email}', '{$pw}');")) === FALSE)
	{
		echo '<h2 style="background-color:white;">USER OR EMAIL EXISTS</h2>';
	}
	else
		header('Location: signin.php');
}
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
			<form action="/signup.php" method="post">
				<div class = "log">Username:<br /><input type = "text" name = "login" placeholder = "Your logo" value = ""></div><br />
				<div class = "log">Email:<br /><input type = "text" name = "email" placeholder = "Your email" value = ""></div><br />
				<div class = "log">Password:<br /><input type = "password" name = "passwd" placeholder = "Your passwd" value = ""></div><br />
				<br /><br /><br /><br />
				<div class = "but"><input type = "submit" name = "submit" value = "OK"></div>
			</form>
			</div>
		</body>
	</html>