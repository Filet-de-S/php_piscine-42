<?php

$name = $sub = $pw = "";
$name = $_POST[login];
$pw = $_POST[passwd];
$sub = $_POST[submit];
if ($sub !== "OK" || $pw === "" || $name === "")
    echo "ERROR\n";
else
{
    $dir = "private";
    $fpw = "/passwd";
    $hash = hash('whirlpool', $pw);
    $data = ['login', $name, $hash];
    $data = serialize([$data]);
    if (file_exists($dir) === FALSE)
        mkdir($dir);
    if (file_exists($dir.$fpw) === FALSE)
        file_put_contents($dir.$fpw, $data);
    else
    {
        $get = unserialize(file_get_contents($dir.$fpw));
        foreach ($get as $v)
            if ($v[1] === $name)
            {
                echo "ERROR\n";
                return ;
            }
        file_put_contents($dir.$fpw, $data, FILE_APPEND);
        print_r($get);
    }
    echo "OK\n";
}
?>