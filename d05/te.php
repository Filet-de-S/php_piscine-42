<?php

$sql = "SELECT 1 FROM User WHERE nom = '" . $argv[1] . "' and pass '" . $argv[2] . "'";

echo $sql.PHP_EOL;

?>
SELECT * FROM film INNER JOIN genre ON film.id_genre = genre.id_genre = 25