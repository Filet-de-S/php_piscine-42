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
$dir = preg_replace('|/$|', "", $dir);
if (substr($a, -1) != '/')
    $a .= "/";
for($i = 0, $j = count($new); $i < $j; $i++)
{
    $new[$i] = preg_replace('/^<(img|IMG)(\s*)(SRC|src)(\s*)="/', "", $new[$i]);
    $new[$i] = preg_replace('/"(\s*)(ALT|alt)(.*)>$/', "", $new[$i]);
    if (preg_match('/^((http|https)|(HTTP|HTTPS))/', $new[$i]) == 1)
    {
        if (is_dir($dir) == FALSE)
            mkdir("$dir");
        $name = preg_replace('/(.*)\//', "", $new[$i]);
        $file = fopen("{$dir}/{$name}", "w");
        $web = fopen($new[$i], 'r');
        stream_copy_to_stream($web, $file);
        fclose($file);
        fclose($web);
    }
    else
    {
        if (is_dir($dir) == FALSE)
            mkdir("$dir");
        $name = preg_replace('/(.*)\//', "", $new[$i]);
        $file = fopen("{$dir}/{$name}", "w");
        if (substr($new[$i], -1) == '/')
            $mew[$i] = preg_replace('|/$|', "", $new[$i]);
        $web = fopen($a.$new[$i], 'r');
        stream_copy_to_stream($web, $file);
        fclose($file);
        fclose($web);
    }
}
?>