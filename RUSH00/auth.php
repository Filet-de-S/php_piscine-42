<?php

function auth($login, $passwd)
{
    if (($login || $passwd) === "")
        return FALSE;
    session_start();
    $link = mysqli_connect('127.0.0.1', 'user', 'user', 'shop');
    
    $que = mysqli_query($link, "SELECT `log`, pw FROM priv;");
    $row = mysqli_fetch_all($que, MYSQLI_ASSOC);
    $passwd = hash('whirlpool', $passwd);
    foreach ($row as $v)
        if ($login === $v[log])
        {
            if ($passwd === $v[pw])
                return TRUE;
            else
                return FALSE;
        }
    return FALSE;
}

