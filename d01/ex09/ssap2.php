#!/usr/bin/php
<?php

if ($argc == 1)
    exit;
function ft_split($str)
{
    if (!$str)
        return (NULL);
    $r = explode(" ", $str);
    $r = array_filter($r);
    return ($r);
}

function stroid_cmp($a, $b)
{
    $i = 0;
    $ai = strlen($a);
    $bi = strlen($b);

    while ($i < $ai && $i < $bi && ((ord($a[$i]) > 64 && ord($a[$i]) < 91) || (ord($a[$i]) > 96 && ord($a[$i]) < 123)) &&
        ((ord($b[$i]) > 64 && ord($b[$i]) < 91) || (ord($b[$i]) > 96 && ord($b[$i]) < 123)) &&
        ((ord($a[$i]) == ord($b[$i])) || 
        (ord($a[$i]) + 32 == ord($b[$i])) || (ord($a[$i]) == ord($b[$i]) - 32) || 
        (ord($a[$i]) - 32 == ord($b[$i])) || (ord($a[$i]) == ord($b[$i]) + 32)))
        $i++;
    while ($i < $ai && $i < $bi && ctype_digit($a[$i]) && ctype_digit($b[$i]) &&
        $a[$i] == $b[$i])
        $i++;
    while ($i < $ai && $i < $bi && ctype_punct($a[$i]) && ctype_punct($b[$i]) && 
        $a[$i] == $b[$i])
        $i++;

    $oa = ord($a[$i]);
    $ob = ord($b[$i]);

    $da = ctype_punct($a[$i]);
    $db = ctype_punct($b[$i]);
    if ($da || $db)
       return ($da == $db ? ($oa - $ob) : ($da == 1 ? 1 : -1));

    $da = ctype_digit($a[$i]);
    $db = ctype_digit($b[$i]);
    if ($da || $db)
        return ($da == $db ? ($oa - $ob) : ($da == 1 ? 1 : -1));

    if (($oa > 64 && $oa < 91) && ($ob > 96 && $ob < 123))
        return ($oa - ($ob - 32));
    else if (($oa > 96 && $oa < 123) && ($ob > 64 && $ob < 91))
        return (($oa - 32) - $ob);
    return ($oa - $ob);
}

function ft_sort($a)
{
    if (!$a)
        return (NULL);
    foreach ($a as $value)
    {
        if (is_numeric($value))
            $nums[] = $value;
        elseif (ctype_punct($value[0]))
            $symbols[] = $value;
        else
            $words[] = $value;
    }

    if ($words)
    {
        usort($words, 'stroid_cmp');
        $fin[] = array_merge($words);
    }
    if ($nums)
    {
        usort($nums, 'stroid_cmp');
        $fin[] = array_merge($nums);
    }
    if ($symbols)
    {
        usort($symbols, 'stroid_cmp');
        $fin[] = array_merge($symbols);
    }
    $fin = call_user_func_array('array_merge', $fin);
    return ($fin);
}

$a = $argv;
array_shift($a);

$a = implode(" ", $a);
$a = ft_split($a);
$s = ft_sort($a);
if ($s)
{
    $s = implode("\n", $s);
    print_r($s);
    echo "\n";
}
?>