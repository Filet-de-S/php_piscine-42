<?php
session_start();
date_default_timezone_set('Europe/Moscow');
if ($_SESSION[loggued_on_user] !== NULL && $_SESSION[loggued_on_user] !== "")
{
	if (file_exists("../private/chat") === FALSE)
		file_put_contents("../private/chat", NULL);
	
	else
	{	$chat = '../private/chat';
		if (($a = file_get_contents($chat)) !== "")
	{
		$fd = fopen($chat, 'r');
		flock($fd, LOCK_SH);
		$ex = unserialize(file_get_contents($chat));
		foreach ($ex as $v)
		{
			$v[time] = date('H:i', $v[time]);
			$out .= "{$v[time]} <b>{$v[login]}</b>: {$v[msg]}<br />\n";
		}
		flock($fd, LOCK_UN);
		fclose($fd);
		echo $out;
	}
	}
}
else
{
	echo "ERROR\n";
}
?>