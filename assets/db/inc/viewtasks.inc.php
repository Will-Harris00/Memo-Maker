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
        /* store the result */
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            /* create the table */
            echo '<script src="https://www.w3schools.com/lib/w3.js"></script>';
            echo '<p>Click the <strong>table headers</strong> to sort the table accordingly or select a <strong>row</strong> to make changes.</p>';
            echo '<br>';
            echo '<div class="container">';
            echo '    <div class="table">';
            echo '        <table id="tasks_table" class="w3-table-all">';
            echo '            <tr><th>Name</th><th>Description</th><th>Due</th><th>Completed</th></tr>';
            /* fetch values */
            while (mysqli_stmt_fetch($stmt)) {
                echo '        <tr class="item">';
                echo '            <td>' . $name . '</td>';
                echo '            <td id="description">' . $description . '</td>';
                echo '            <td>' . $due . '</td>';
                echo '            <td>' . $state . '</td>';
                echo '        </tr>';
            }
            echo '        </table>';
            echo '    </div>';
            echo '    <div class="edit" id="edit">';
            echo '        Name:<input type="text" name="name" id="name"><br><br>';
            echo '        Description:<input type="text" name="description" id="description"><br><br>';
            echo '        Due:<input type="text" name="due" id="due"><br><br>';
            echo '        State:<input type="text" name="state" id="state"><br><br>';
            echo '        <button onclick="editRow();">Edit Row</button><br><br>';
            echo '    </div>';
            echo '</div>';
            echo '<script src="../js/sort.js"></script>';
            echo '<script src="../js/edittasks.js"></script>';

            /* close statement */
            mysqli_stmt_close($stmt);
            /* close connection */
            mysqli_close($conn);
            exit();
        } else {
            echo '<p>There no tasks available to display. Begin by <strong><a href="add-tasks.php">creating a task.</a></strong></p>';
        }
    }
}
?>