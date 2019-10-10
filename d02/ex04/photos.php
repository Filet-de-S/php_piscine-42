#!/usr/bin/php 
<?php

$a = $argv[1];
$fd = curl_init($a);
curl_setopt($fd, CURLOPT_RETURNTRANSFER, true);
$parseme = curl_exec($fd);

$fin = NULL;
preg_match_all('/<(img|IMG) .*(((src|SRC)\s*=".+"(\s*(alt|ALT)\s*=".+")?)|((\s*(alt|ALT)\s*=".+")?(src|SRC)\s*=".+"))\s*>/', $parseme, $fin);
for ($i = 0, $j = count($fin[0]); $i < $j; $i++)
    $new[] = $fin[0][$i];
print_r($new);

$new[0] = preg_filter("|(.*/)?|", "", $new[0]);
$new[1] = preg_filter("|(.*/)?|", "", $new[1]);

var_dump($new[0]);

/*
$> ./photos.php "http://www.42.fr"
$> ls
photos.php
www.42.fr/
$> ls www.42.fr/
logo42-site.gif
*/
?>