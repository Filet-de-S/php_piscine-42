<?php
session_start();
$link = mysqli_connect('127.0.0.1', 'user', 'user', 'shop');


if (($que = mysqli_query($link, "SELECT `name`, price FROM products LIMIT 4;")) === FALSE)
    echo "ERROR DURING QUERYING IMAGES";

$row = mysqli_fetch_all($que, MYSQLI_ASSOC);
foreach ($row as $v)
	{
    ?>
	<div class = "branch">
    <img class = "icon" src="resources/<?=$v[name]?>.jpg"/> 
	<form action="/addtobasket.php" method="post">
	<input type="hidden" name="tovar" value="<?=$v[name]?>"/>
	<h3><?=$v[price]?></h3>
	<input type="submit" name="submit" value="Add to basket"/>
	</div>
	</form>
    <?php
    }
?>




