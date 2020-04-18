<?php
session_start();

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    /* the script is not being run from this page rather it is imported
    into view-tasks.php hence the strange directory mappings. */
    require "../secure/credentials.php";
    require "inc/handler.inc.php";

    $sql = "SELECT name, taskid, description, due, state 
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
        mysqli_stmt_bind_result($stmt, $name, $taskid, $description, $due, $state);
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
            echo '            <tr><th>Name</th><th>Description</th><th>Due</th><th>Done</th></tr>';
            /* fetch values */
            $i = 0;
            while (mysqli_stmt_fetch($stmt)) {
                echo "        <input type='hidden' id='$i' value='$taskid'>";
                echo '        <tr class="item">';
                echo '            <td id="name_scroll"><div class="name_scroll">' . $name . '</div></td>';
                /* desc id added to allow for manipulation of cell height by setting content div max-height */
                echo '            <td id="desc_scroll"><div class="desc_scroll">' . $description . '</div></td>';
                echo '            <td>' . date("D j, M, Y, H:i", strtotime($due)) . '</td>';
                echo '            <td>' . $state . '</td>';
                echo '        </tr>';
                $i++;
            }
            echo '        </table>';
            echo '    </div>';
            echo '    <div class="edit" id="edit">';
            echo '        <form name="edit_task" action="inc/edittask.inc.php" method="post">';
            echo '            <input type="hidden" name="taskid" id="taskid">';
            echo '            <strong>Name:</strong><input type="text" name="name" id="name" required="required"><br><br>';
            echo '            <strong>Description:</strong><input type="text" name="description" id="description" pattern="[a-zA-Z0-9\w\s\p{P}\p{S}].{0,254}" required="required"><br><br>';
            echo '            <strong>Due Date:</strong><input type="date" name="date" id="date" max="9999-12-31"><br><br>';
            echo '            <strong>Time:</strong><input type="time" name="time" id="time"><br><br>';
            echo '            <strong>Done:</strong><input type="text" name="state" id="state" pattern="[01].{0}" required="required"><br><br>';
            echo '            <input type="submit" name="edit_task_btn" id="edit_task_btn" value="Edit Task"><br><br>';
            echo '        </form>';
            echo '    </div>';
            echo '</div>';
            echo '<script src="../js/sort.js"></script>';
            echo '<script src="../js/edittask.js"></script>';
            echo '<script src="../js/valtextarea.js"></script>';

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