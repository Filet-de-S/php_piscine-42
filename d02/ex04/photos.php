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
$dir = preg_replace('/(\s*)((http|https)|(HTTP|HTTPS)):\/\//', "", $a);

for($i = 0, $j = count($new); $i < $j; $i++)
{
    $new[$i] = preg_replace('/^<(img|IMG)(\s*)(SRC|src)(\s*)="/', "", $new[$i]);
    $new[$i] = preg_replace('/"(\s*)(ALT|alt)(.*)>$/', "", $new[$i]);
    if (preg_match('/^((http|https)|(HTTP|HTTPS))/', $new[$i]) == 1)
    {
        echo $new[$i]."\n";
        if (is_dir($dir) == FALSE)
            mkdir("$dir");
        $name = preg_replace('/(.*)\//', "", $new[$i]);
        $file = fopen("{$dir}/{$name}", "w");
        $web = stream_copy_to_stream($new[$i], $file);
        fclose($file);
        fclose($web);
    }
    else
    {
        if (is_dir($dir) == FALSE)
            mkdir("$dir");
        $name = preg_replace('/(.*)\//', "", $new[$i]);
        $file = fopen("{$dir}/{$name}", "w");
    }
}

print_r($new);

/*
$> ./photos.php "http://www.42.fr"
$> ls
photos.php
www.42.fr/
$> ls www.42.fr/
logo42-site.gif


file_get_contents
file_put_contents

*/
?>