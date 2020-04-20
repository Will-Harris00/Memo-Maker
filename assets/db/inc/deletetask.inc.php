<?php
session_start();

if (isset($_POST['delete_btn'])) {
    $userid = $_SESSION['userid'];
    $taskid = $_POST['taskid'];
    echo $userid;
    echo '<br>';
    echo $taskid;
}
?>
