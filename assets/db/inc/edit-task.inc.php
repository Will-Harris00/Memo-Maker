<?php
session_start();

if (isset($_POST['edit_task_btn'])) {
    $userid = $_SESSION['userid'];
    $taskid = $_POST['taskid'];
    $name = $_POST['name'];
    $due =  date('Y-m-d H:i', strtotime(str_replace("/","-",$_POST['date']) . $_POST['time']));
    $description = $_POST['description'];
    $state = $_POST['state'];
    require "handler.inc.php";

    if (empty($name) || empty($due) || empty($description)) {
        header("Location: ../view-tasks.php?error=emptyfields&userid=" . $userid);
        mysqli_close($conn);
        exit();
    } else {
        /* Matches both taskid and userid to confirm that the logged
           in user created that task and has permission to edit it. */
        $sql = "UPDATE Tasks
                SET name = ?, description = ?, due = ?, state = ?
                WHERE taskid = $taskid AND userid = $userid";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../view-tasks.php?error=sqluserinserterror&userid=" . $userid);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssi", $name, $description, $due, $state);
            mysqli_stmt_execute($stmt);
            header("Location: ../view-tasks.php?updatedtask=success");
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        }
    }
}
?>