<?php
session_start();

if (isset($_SESSION['userid'])) {
    $userid = htmlspecialchars($_SESSION['userid']);
    require "handler.inc.php";

    $sql = "SELECT taskid, importid, name, description, due, state
            FROM Tasks 
            WHERE userid=?";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../view-tasks.php?error=sqltasksrequesterror&userid=" . $userid);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    } else {
        /* Bind variable to statement */
        mysqli_stmt_bind_param($stmt, "i", $userid);
        /* Execute statement */
        mysqli_stmt_execute($stmt);
        /* Bind result variables */
        mysqli_stmt_bind_result($stmt, $taskid, $importid, $name, $description, $due, $state);
        /* Store the result */
        mysqli_stmt_store_result($stmt);
        /* Array used to store the tasks */
        $tasks = array();
        if (mysqli_stmt_num_rows($stmt) > 0) {
            while (mysqli_stmt_fetch($stmt)) {
                /* Iterates over every matching row */
                array_push($tasks, array(
                    'taskid' => $taskid,
                    'userid' => $userid,
                    'importid' => $importid,
                    'name' => $name,
                    'description' => $description,
                    'due' => $due,
                    'state' => $state,
                ));
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    $_SESSION['tasks'] = $tasks;
    // var_dump($tasks);
    header("Location: ../view-tasks.php");
    exit();
} else {
    header("Location: ../login.php");
    exit();
}
?>