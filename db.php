<?php

$host = 'localhost';
$dbname = 'crud';
$username = 'root';
$pass = '';

$conn = mysqli_connect($host, $username, $pass, $dbname);

if (!$conn) die("fatal error");
//echo "success connect";
