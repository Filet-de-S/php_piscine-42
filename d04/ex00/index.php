<?php
session_start();
if ($_GET[submit] == "OK")
    {
        $_SESSION[log] = $_GET[login];
        $_SESSION[pw] = $_GET[passwd];
    }
?>
<html><body>
<form action="/index.php" method="get">
Username: <input type="text" name="login" value="<?=$_SESSION[log]?>" />
<br />
Password: <input type="password" name="passwd" value="<?=$_SESSION[pw]?>"/>
<input type="submit" value="OK"/>
</form>
</body></html>