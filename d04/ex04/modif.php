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
	{
		header("Location: /modif.html");
		echo "ERROR\n";
	}
else
{
	$chat = $dir.$fpw;
	$fd = fopen($chat, 'r');
	flock($fd, LOCK_EX);
	$data = [$name, $oldpw];
	$get = unserialize(file_get_contents($chat));
	foreach ($get as &$v)
		if ($v[0] === $name)
		{
			$oldpw = hash('whirlpool', $oldpw);
			if ($oldpw !== $v[1])
			{
				header("Location: /modif.html");
				echo "ERROR\n";
			}
			$v[1] = hash('whirlpool', $newpw);
			file_put_contents($chat, serialize($get));
			flock($fd, LOCK_UN);
			fclose($fd);
			header("Location: /index.html");
			echo "OK\n";
		}
	flock($fd, LOCK_UN);
	fclose($fd);
	header("Location: /modif.html");
	echo "ERROR\n";
}
?>