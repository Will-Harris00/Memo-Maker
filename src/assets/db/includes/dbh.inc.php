<?php
$servername = "emps-sql.ex.ac.uk";
$username = "wjph202";
$password = "wjph202";
$database = "wjph202";
$conn = new mysqli($servername, $username, $password, $database);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
} else{
    echo "Connected successfully to database<br/>";
}
?>
