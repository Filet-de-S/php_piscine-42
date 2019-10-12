<?php
session_start();

$log = $_POST[login];
$pw = $_POST[passwd];
$dir = "../private/passwd";

if (($log === "" || $log == NULL) || $pw === "" || $pw == NULL ||
    file_exists($dir) === FALSE)
{
    header('Location: /index.html');
    echo "ERROR\n";
}

include 'auth.php';
if (auth($log, $pw) === TRUE) {
    $_SESSION[loggued_on_user] = $log;
echo '<iframe src="/chat.php" name="chat" width="100%" height="550px"></iframe>
<iframe src="/speak.php" name="speak" width="100%" height="50px"></iframe>
';
} else { $_SESSION[loggued_on_user] = "";
echo "ERROR\n"; }
?>