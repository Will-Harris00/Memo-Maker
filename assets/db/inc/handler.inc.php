<?php
session_start();
require "../../secure/credentials.php";
$conn = mysqli_connect(host, user, password, database, port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . PHP_EOL);
}
?>
