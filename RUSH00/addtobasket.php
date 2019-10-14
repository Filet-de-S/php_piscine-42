<?php
session_start();
$link = mysqli_connect('127.0.0.1', 'user', 'user', 'shop');

	if ($_POST[submit] === "Add to basket")
	{
		$tovar = $_POST['tovar'];
		if (($price = mysqli_query($link, "SELECT price FROM products WHERE `name` = '{$tovar}';")) === FALSE)
			echo "DAJ CENU" . mysqli_error($link);
		$row = mysqli_fetch_array($price);
		$price = $row[0];
		$id = $_COOKIE[PHPSESSID];
		if ((mysqli_query($link, "INSERT INTO basket VALUES ('{$tovar}', {$price}, '{$id}');")) === FALSE)
			echo "bja ne mogu" . mysqli_error($link);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>