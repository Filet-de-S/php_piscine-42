<?php

function auth($login, $passwd)
{
    if (($login || $passwd) === "")
        return FALSE;
    $file = unserialize(file_get_contents("../private/passwd"));
    $passwd = hash('whirlpool', $passwd);
    foreach ($file as $v)
        if ($login === $v[0])
        {
            if ($passwd === $v[1])
                return TRUE;
            else
                return FALSE;
        }
    return FALSE;
}

