<?php

$arr = $_GET;
$act = $arr[action];

if ($act != "get" && $act != "del" && $act != "set")
    exit;
if ($act == "set")
    setcookie($arr[name], $arr[value], time() + 600);
elseif ($act == "get")
{
    if ($_COOKIE[$arr[name]])
        echo($_COOKIE[$arr[name]]."\n");
}
else
    setcookie ($arr[name], $arr[value], -1);
?>