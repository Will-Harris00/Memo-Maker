<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location: login.php");
    exit();
}
?>

<p> Hello <?php echo $_SESSION["user"]; ?></p>
<p><a href="logout.php">Click here</a> to log out</p>