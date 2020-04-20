<?php
session_start();

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    /* the script is not being run from this page rather it is imported
    into view-tasks.php hence the strange directory mappings. */
    require "../secure/credentials.php";
    require "inc/handler.inc.php";

    $sql = "SELECT name, taskid, importid, description, due, state 
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
        mysqli_stmt_bind_result($stmt, $name, $taskid, $importid, $description, $due, $state);
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
                echo "            <td onclick='event.stopPropagation();return false;'>";
                if ($state == 0) {
                    echo "            <input type='checkbox' class='toggle_state' id='check-$taskid' value='{$state}' onclick='event.stopPropagation();return true;'>";
                } else {
                    echo "            <input type='checkbox' class='toggle_state' id='check-$taskid' checked value='{$state}' onclick='event.stopPropagation();toggleState({$importid}, {$taskid}, {$userid});return true;'>";
                }
                echo "            </td>";
                echo '        </tr>';
                $i++;
            }
            echo '        </table>';
            echo '    </div>';
            echo '    <div class="edit" id="edit">';
            echo '        <form name="edit_task" action="inc/edit-task.inc.php" method="post" onsubmit="return confirm(\'Do you really want to submit the form?\');">';
            echo '            <input type="hidden" name="taskid" id="taskid">';
            echo '            <strong>Name:</strong><input type="text" name="name" id="name" pattern="[a-zA-Z0-9\w\s\p{P}\p{S}].{0,254}" required="required"><br><br>';
            echo '            <strong>Description:</strong><textarea id="description" name="description" rows="4" cols="80" required="required"></textarea><br><br>';
            echo '            <strong>Due Date:</strong><input type="date" name="date" id="date" max="9999-12-31"><br><br>';
            echo '            <strong>Time:</strong><input type="time" name="time" id="time"><br><br>';
            echo '            <strong>Done:</strong><input type="text" name="state" id="state" pattern="[01].{0}" required="required"><br><br>';
            echo '            <input type="submit" name="edit_task_btn" id="submit_btn" value="Edit Task">';
            echo "            <button type='button' name='cancel_btn' id='cancel_btn' onclick='document.getElementById(\"edit\").style.visibility = \"hidden\";'>Cancel</button>";
            echo "        <button type='submit' name='delete_btn' id='delete_btn' formaction='inc/delete-task.inc.php'>Delete Task</button>";
            echo '        </form>';
            echo '    </div>';
            echo '</div>';
            echo '<script src="../js/sort-column.js"></script>';
            echo '<script src="../js/edit-task.js"></script>';
            echo '<script src="../js/validate-txt.js"></script>';

            /* close statement */
            mysqli_stmt_close($stmt);
            /* close connection */
            mysqli_close($conn);
            exit();
        } else {
            echo '<p>There no tasks available to display. Begin by <strong><a id="no_tasks" href="add-tasks.php">creating a task.</a></strong></p>';
        }
    }
}
?>