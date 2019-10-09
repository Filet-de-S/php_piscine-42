#!/usr/bin/php
<?php
if ($argv < 2)
    exit;
$a = preg_replace("/^ | $/", "", preg_replace('/[\s]+/', " ", $argv[1]));
print_r($a."\n");
?>