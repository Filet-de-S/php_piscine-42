#!/usr/bin/env php
<?php
$s = file_get_contents($argv[1]);
preg_match_all('/<(img|IMG) .*(((src|SRC)\s*=".+"(\s*(alt|ALT)\s*=".+")?)|((\s*(alt|ALT)\s*=".+")?(src|SRC)\s*=".+"))\s*>/', $s, $fin);

print_r($fin);

?>


preg_match_all('/<(img|IMG) .*(src|SRC)\s*=".+"(\s*(alt|ALT)\s*=".+")?\s*>/', $parseme, $fin);
