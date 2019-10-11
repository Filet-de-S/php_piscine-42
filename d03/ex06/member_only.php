<?php
$a = $_SERVER;
header("WWW-Authenticate: Basic realm=''Member area''");
if ($_SERVER[PHP_AUTH_USER] == "zaz" && $_SERVER[PHP_AUTH_PW] == "Ilovemylittleponey")
{
    ?>
<html><body>
Hello Zaz<br />
<img src='data:image/png,base64,<?php echo base64_encode(file_get_contents('../img/42.png')); ?>>
</body></html>
<?php
}
else
    {
        header('HTTP/1.0 401 Unauthorized');
        header('Date: Tue, 26 Mar 2013 09:42:42 GMT');
        header('Server: Apache');
        header('Content-type: text/html');

?>
<html><body>That area is accessible for members only</body></html>
<?php
    }
?>
