<?php
header('Date: Tue, 26 Mar 2013 09:42:42 GMT');
header('Server: Apache');
header('Content-Type: image/png');
$file = '../img/42.png';
readfile($file);
?>