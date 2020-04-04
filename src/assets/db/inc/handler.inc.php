<?php

$host = "emps-sql.ex.ac.uk";
$username = "wjph202";
$password = "wjph202";
$database = "wjph202";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error().PHP_EOL);
}