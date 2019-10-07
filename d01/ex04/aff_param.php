#!/usr/bin/php
<?php

$a = $argv;

array_shift($a);
$a = implode("\n", $a);
print_r($a);
if ($argc != 1)
    echo "\n";
?>