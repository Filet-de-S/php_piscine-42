#!/usr/bin/php
<?php
function ft_split($str)
{
    if (!$str)
        return (NULL);
    $r = explode(" ", $str);
    $r = array_filter($r);
    sort($r);
    return ($r);
}
?>