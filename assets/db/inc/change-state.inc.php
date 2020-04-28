<?php
// This script handles change in state for local tasks.
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['taskid'])) {
    $userid = htmlspecialchars($_SESSION['userid']);
    $taskid = htmlentities($_POST['taskid']);
    $state = htmlentities($_POST['state']);
    require "handler.inc.php";

    if (empty($userid) || empty($taskid) || !isset($state)) {
        header("Location: ../view-tasks.php?error=emptyfields&userid=" . $userid);
        mysqli_close($conn);
        exit();
    } else {
        /* Matches both taskid and userid to confirm that the logged
           in user created that task and has permission to edit it. */
        $sql = "UPDATE Tasks
                SET state = ?
                WHERE taskid = ? AND userid = ?";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../view-tasks.php?error=sqluserinserterror&userid=" . $userid);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "iii", $state, $taskid, $userid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            echo "Status updated successfully.";
            exit();
        }
    }
} else {
    header("Location: ../view-tasks.php");
    exit();
}
?>
