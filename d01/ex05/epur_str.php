#!/usr/bin/php
<?php

$r = $argv[1];
$r = explode(" ", $r);
$r = array_filter($r);
$r = implode(" ", $r);

print_r($r);
if ($argc != 1)
    echo "\n";
?>