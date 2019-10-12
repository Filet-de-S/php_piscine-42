<?php

$name = $sub = $oldpw = $newpw = "";
$name = $_POST[login];
$oldpw = $_POST[oldpw];
$newpw = $_POST[newpw];
$sub = $_POST[submit];
$dir = "../private";
$fpw = "/passwd";

if ($sub !== "OK" || $oldpw === "" || $newpw === "" || $name === "" ||
	file_exists($dir) === FALSE || file_exists($dir.$fpw) === FALSE)
	echo "ERROR\n";
else
{
	$data = [$name, $oldpw];
	$get = unserialize(file_get_contents($dir.$fpw));
	foreach ($get as &$v)
		if ($v[0] === $name)
		{
			$oldpw = hash('whirlpool', $oldpw);
			if ($oldpw !== $v[1])
			{
				echo "ERROR\n";
				return;
			}
			$v[1] = hash('whirlpool', $newpw);
			file_put_contents($dir.$fpw, serialize($get));
			echo "OK\n";
			return ;
		}
	echo "ERROR\n";
}
?>