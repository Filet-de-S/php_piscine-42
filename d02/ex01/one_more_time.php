#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");
if ($argc == 2)
{
    if ((preg_match("/ $/", $argv[1]) == TRUE))
    {
        echo "Wrong Format\n";
        exit;
    }
    $a = preg_split("/ /", $argv[1]);
    if ((preg_match("/^(([Ll]un|[Mm]ar|[Mm]ercre|[Jj]eu|[Vv]endre|[Ss]ame)di|[Dd]imanche)$/", $a[0]) 
    == FALSE) || (preg_match("/^[\d]{1,2}$/", $a[1] == FALSE)) || 
    (preg_match("/^([Jj]anvier|[Ff]évrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]out|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]écembre)$/", $a[2]) == FALSE) ||
    (preg_match("/^[\d]{4}$/", $a[3]) == FALSE) || (preg_match("/^([\d]{2}):(?1):(?1)$/", $a[4]) == FALSE))
        echo "Wrong Format\n";
    else
    {
        $a[2] = strtolower($a[2]);
        if ($a[2] == "janvier") $a[2] = 1;
        elseif ($a[2] == "février") $a[2] = 2;
        elseif ($a[2] == "mars") $a[2] = 3;
        elseif ($a[2] == "avril") $a[2] = 4;
        elseif ($a[2] == "mai") $a[2] = 5;
        elseif ($a[2] == "juin") $a[2] = 6;
        elseif ($a[2] == "jullet") $a[2] = 7;
        elseif ($a[2] == "aout") $a[2] = 8;
        elseif ($a[2] == "septembre") $a[2] = 9;
        elseif ($a[2] == "octobre") $a[2] = 10;
        elseif ($a[2] == "novembre") $a[2] = 11;
        else $a[2] = 12;

        $a[0] = strtolower($a[0]);
        if ($a[0] == "lundi") $a[0] = 1;
        elseif ($a[0] == "mardi") $a[0] = 2;
        elseif ($a[0] == "mercredi") $a[0] = 3;
        elseif ($a[0] == "jeudi") $a[0] = 4;
        elseif ($a[0] == "vendredi") $a[0] = 5;
        elseif ($a[0] == "samedi") $a[0] = 6;
        else $a[0] = 7;

        if (($fin = strtotime("{$a[1]}.{$a[2]}.{$a[3]} $a[4]")) == FALSE ||
        date('N', $fin) != $a[0])
            echo "Wrong Format\n";
        else echo $fin."\n";
    }
}
else
    echo "Wrong Format\n";
?>