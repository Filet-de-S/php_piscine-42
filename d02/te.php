#!/usr/bin/env php
<?php

if (preg_match('/^((http|https)|(HTTP|HTTPS))/', "https://www.42.fr/wp-content/themes/42/images/42_logo_black.svg") == 1)
    echo "ok";


?>