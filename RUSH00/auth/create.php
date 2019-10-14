<?php

$name = $sub = $pw = "";
$name = $_POST[login];
$pw = $_POST[passwd];
$sub = $_POST[submit];

if ($sub !== "OK" || $pw === "" || $name === "")
{
	header("Location: /create.html");
	echo "ERROR\n";
}
else
{
	$dir = "../private";
	$fpw = "/passwd";
	$data = [$name, hash('whirlpool', $pw)];
	if (file_exists($dir) === FALSE)
		mkdir($dir);
	if (file_exists($dir.$fpw) === FALSE)
	{
		$new[] = $data;
		file_put_contents($dir.$fpw, serialize($new));
	}
	else
	{
		$chat = $dir.$fpw;
		$fd = fopen($chat, 'r');
		flock($fd, LOCK_EX);
		$get = unserialize(file_get_contents($dir.$fpw));
		foreach ($get as $v)
			if ($v[0] === $name)
			{
				header("Location: /create.html");
				echo "ERROR\n";
			}
		$get[] = $data;
		file_put_contents($dir.$fpw, serialize($get));
		flock($fd, LOCK_UN);
		fclose($fd);
	}
	header("Location: /index.php");
	echo "OK\n";
}
?>