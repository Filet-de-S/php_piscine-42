#!/usr/bin/php
<?php

$a = $argv;
$n = $a[1];
array_shift($a);
array_shift($a);
$fin = NULL;
foreach ($a as $key => $value)
{
    $k = preg_replace("/:.+$/", "", $value);
    $value = preg_replace("/^.+:/", "", $value);
    $a[$k] = $value;
    unset($a[$key]);
}
if ($a[$n])
    print_r($a[$n]."\n");
?>