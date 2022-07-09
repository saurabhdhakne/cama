<?php

$servername = 'localhost';
$username = 'root';
$password = 'CodeAppMedia@9860';
$dbname = 'codeappmediaar';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

?>
