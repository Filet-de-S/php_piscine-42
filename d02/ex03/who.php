#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Moscow");
$file = "/var/run/utmpx";
$fd = fopen($file, "r");
$res = fread($fd, 1256);

$fl = 1;
$fin = NULL;
$res = 1;
while ($res != NULL)
{
    $fl = 1;
    if (($user = fread($fd, 256)) == NULL) break;
    $user = unpack('a256', $user);
    $tmp = str_pad(trim($user[1]), 8, " ", STR_PAD_RIGHT);
    $res = fread($fd, 4);
    $id = fread($fd, 32);
    $tmp .= " ".str_pad(trim($id), 8, " ", STR_PAD_RIGHT)." ";
    $res = fread($fd, 4);
    if (($res = fread($fd, 4)) == NULL) break;
    $us = unpack('i', $res);
    if ($us[1] != 7)
        $fl = -1; // 7 ==  user process (alive)
    if (($res = fread($fd, 4)) == NULL) break;
    $in = unpack('i', $res);
    $tim = date('M j H:i', $in[1]);
    $tmp .= $tim;
    $res = fread($fd, 4);
    $res = fread($fd, 256);
    $res = fread($fd, 64);
    if ($fl != 1)
        continue;
    if ($fin == NULL)
        $fin = $tmp;
    else
        $fin .= "\n$tmp";
}
print_r("$fin \n");
fclose($fd);

/*
628 bytes

https://github.com/libyal/dtformats/blob/master/documentation/Utmp%20login%20records%20format.asciidoc
*/

?>