<?php

//$connect = mysqli_connect('database', 'root', 'tiger', 'php_cms_db');
//if ($mysqli) echo 'connected';

$mysqli = new mysqli('database', 'root', 'tiger', 'php_cms_db');

if ($mysqli->connect_errno) {
    echo "Failed to connect to Mysql " . $mysqli->connect_error;
    exit();
}

