<?php
session_start();

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    /* the script is not being run from this page rather it is imported
    into view-tasks.php hence the strange directory mappings. */
    require "../secure/credentials.php";
    require "inc/handler.inc.php";

    $sql = "SELECT name, description, due, state 
            FROM Tasks 
            WHERE userid=?";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../view-tasks.php?error=sqltasksrequesterror&userid=" . $userid);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    } else {
        /* bind variable to statement */
        mysqli_stmt_bind_param($stmt, "i", $userid);
        /* execute statement */
        mysqli_stmt_execute($stmt);
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $name, $description, $due, $state);
        /* create the table */
        echo '<script src="https://www.w3schools.com/lib/w3.js"></script>';
        echo '<p>Click the <strong>table headers</strong> to sort the table accordingly.</p>';
        echo '<br>';
        echo '<table id="tasks_table" class="w3-table-all">';
        echo '<tr><th>Name</th><th>Description</th><th>Due</th><th>Completed</th></tr>';
        /* fetch values */
        while (mysqli_stmt_fetch($stmt)) {
            echo '<tr class="item">';
            echo '<td><a href="http://localhost:5000/cancel?alarm_cancel={{ alarms[0] }}">' . $name . '</td>';
            echo '<td>' . $description . '</td>';
            echo '<td>' . $due . '</td>';
            echo '<td>' . $state . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<script src="../js/sort.js"></script>';
        //}
        /* close statement */
        mysqli_stmt_close($stmt);
        /* close connection */
        mysqli_close($conn);
        exit();
    }
}
?>