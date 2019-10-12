<?php
session_start();

$log = $_GET[login];
$pw = $_GET[passwd];
include 'auth.php';

if (auth($log, $pw) === TRUE) {
    $_SESSION[loggued_on_user] = $log;
    echo "OK\n";
} else
{
    $_SESSION[loggued_on_user] = "";
    echo "ERROR\n";
}
?>