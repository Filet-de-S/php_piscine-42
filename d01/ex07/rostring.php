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

$s = ft_split($argv[1]);
$i = count($s);

if ($i == 1)
{
    echo $s[0]."\n";
    exit;
}
$s = array_values($s);
$s[$i] = $s[0];
array_shift($s);
$s = implode(" ", $s);
print_r($s);
echo "\n";

?>