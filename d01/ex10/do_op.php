#!/usr/bin/php
<?php

if ($argc != 4)
{
	print_r("Incorrect Parameters\n");
	exit;
}

$a = $argv;
array_shift($a);
$a[0] = trim($a[0], " \t");
$a[1] = trim($a[1], " \t");
$a[2] = trim($a[2], " \t");
$a = array_values($a);

if ($a[1] == '+')
	$fin = $a[0] + $a[2];
elseif ($a[1] == '-')
	$fin = $a[0] - $a[2];
elseif ($a[1] == "*")
	$fin = $a[0] * $a[2];
elseif ($a[1] == '/')
	$fin = $a[0] / $a[2];
else
	$fin = $a[0] % $a[2];
echo $fin."\n";
?>