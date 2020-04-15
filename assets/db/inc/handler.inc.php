<?php
session_start();
/* cannot use credentials here as they are imported directly into the parent script
 the benefit of doing so is that refactoring becomes easier as script can be moved
between directories without making changes to the path stored within this script. */
$conn = mysqli_connect(host, user, password, database, port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . PHP_EOL);
}
?>
