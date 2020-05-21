<?php
session_start();
require "../../secure/credentials.php";
$conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE, PORT);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . PHP_EOL);
}
?>
