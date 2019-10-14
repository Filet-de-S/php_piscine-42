<?php
session_start();
date_default_timezone_set('Europe/Moscow');

if ($_SESSION[loggued_on_user] !== NULL && $_SESSION[loggued_on_user] !== "")
{
?>
<html>
    <head>
    <script language="javascript">top.frames['chat'].location='chat.php';</script>
    </head>
<body>
<form action="/speak.php" method="post">
<input style="width:100%;"type="text" name="msg" value="" />
<input type="submit" style="display:none;" name="submit" value="OK"/>
</form>
</body></html>
<?php
    if ($_POST[submit] == "OK")
    {
      if ($_POST[msg] !== "")
      { 
        $arr = ['login'=>$_SESSION[loggued_on_user], 'time'=>date('U', time(0)) , 'msg'=>$_POST[msg]];
        $chat = '../private/chat';
        if (file_exists($chat) === FALSE)
        {
            $ex[] = $arr;
            file_put_contents($chat, serialize($ex));
        }
        else
        {
            $fd = fopen($chat, 'r');
            flock($fd, LOCK_EX);
            $ex = unserialize(file_get_contents($chat));
            $ex[] = $arr;
            file_put_contents($chat, serialize($ex));
            flock($fd, LOCK_UN);
            fclose($fd);
        }
       }
    }
}
else
    echo "ERROR\n";
?>