#!/usr/bin/php
<?php
$s = file_get_contents($argv[1]);
$s = preg_replace_callback('|<a(.*)title="(.*)">(.*)<\/a>|', 
    function ($m) {
        return "<a$m[1]title=\"". strtoupper($m[2]) ."\">" . strtoupper($m[3]) . "</a>";
    }, $s);
$s = preg_replace_callback('|<a(.*)>(.*)<(.*)<\/a>|', 
    function ($m) {
        return "<a$m[1]>". strtoupper($m[2]) . "<$m[3]</a>";
    }, $s);
print_r($s);
?>