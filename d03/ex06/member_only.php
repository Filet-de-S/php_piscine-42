<?php
$a = $_SERVER;
header("Date: Tue, 26 Mar 2013 09:42:42 GMT");
header("Server: Apache");
header("WWW-Authenticate: Basic realm=''Member area''");


$login = base64_encode("zaz:Ilovemylittleponey");

if ($_SERVER[HTTP_AUTHORIZATION] == "Basic {$login}")
{
    $imag = '../img/42.png';
    $imag = base64_encode(file_get_contents($imag));
    header('HTTP/1.0 200 Authorized');
    echo "<html><body>\nHello Zaz<br />\n<img src='data:image/png;base64,{$imag}'>\n</body></html>\n";
}
else
    {
    header('HTTP/1.0 401 Unauthorized');
    header('Content-Length: 72');
?>
<html><body>That area is accessible for members only</body></html>     
<?php
    }
?>
