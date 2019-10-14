<?php
session_start();
$link = mysqli_connect('127.0.0.1', 'user', 'user', 'shop');


if (($que = mysqli_query($link, "SELECT `name` FROM products WHERE branch = 'unix';")) === FALSE)
    echo "ERROR DURING QUERYING IMAGES";

while ($row = mysqli_fetch_array($que)):
?>
    <img class = "img" src="resources/<?=$row[0]?>.jpg"/> 
    <form action="/addtobasket.php" method="post">
    <input type="hidden" name=$tovar value="$tovarname"/>
    <input type="submit" name="submit" value="Add to basket"/>
    </form>
<?php endwhile; ?>