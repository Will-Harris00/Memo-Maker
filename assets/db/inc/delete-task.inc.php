<?php
session_start();

if (isset($_POST['delete_btn'])) {
    $userid = $_SESSION['userid'];
    $taskid = $_POST['taskid'];
    require "handler.inc.php";

    if (empty($userid) || empty($taskid)) {
        header("Location: ../login.php?error=emptyfields&userid=" . $userid);
        mysqli_close($conn);
        exit();
    } else {
        /* Matches both taskid and userid to confirm that the logged in
           user created that task and has permission to delete it. */
        $sql = "DELETE FROM Tasks
                WHERE taskid=? AND userid=?";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqluserrequesterror&user=" . $userid);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ii", $taskid, $userid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ../view-tasks.php");
            exit();
        }
    }
}
?>
