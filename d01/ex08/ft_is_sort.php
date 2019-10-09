<?php
function ft_is_sort($arr)
{
    $tmp = $arr;
    sort($arr);

    $fl = true;
    foreach($arr as $key=>$value)
        if ($value != $tmp[$key])
        {
            $fl = false;
            break ;
        }
    return ($fl);
}
?>