#!/usr/bin/php
<?php

if ($argc == 1)
    exit;
function ft_split($str)
{
    if (!$str)
        return (NULL);
    $r = explode(" ", $str);
    $r = array_filter($r);
    return ($r);
}

$a = $argv;
array_shift($a);
$a = implode(" ", $a);
$a = ft_split($a);
sort($a);
$a = implode("\n", $a);

print_r($a);
echo "\n";

?>