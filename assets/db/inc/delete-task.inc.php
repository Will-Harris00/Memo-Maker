<?php
// This script handles deletion of both local and remote.
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['taskid']) or isset($_POST['delete_btn'])) {
    $userid = htmlspecialchars($_SESSION['userid']);
    $taskid = htmlentities($_POST['taskid']);
    require "handler.inc.php";

    if (empty($userid) || empty($taskid)) {
        header("Location: ../view-tasks.php?error=emptyfields&userid=" . $userid);
        mysqli_close($conn);
        exit();
    } else {
        /* Matches both taskid and userid to confirm that the logged
           in user created that task and has permission to edit it. */
        $sql = "DELETE FROM Tasks
                WHERE taskid=? AND userid=?";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../view-tasks.php?error=sqluserinserterror&userid=" . $userid);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ii", $taskid, $userid);
            mysqli_stmt_execute($stmt);
            if (isset($_POST['delete_btn'])) {
                header("Location: view-tasks.inc.php");
            } else {
                // echos are returned in javascript function
                echo "Task deleted successfully.";
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        }
    }
} else {
    header("Location: view-tasks.inc.php");
    exit();
}
