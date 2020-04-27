<?php
session_start();
require "header.php";
$tasks = $_SESSION['tasks'];
if (count($tasks) == 0) {
    echo '<p>There no tasks available to display. Begin by <strong><a id="no_tasks" href="add-tasks.php">creating a task.</a></strong></p>';
    exit();
}
?>

    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <p>Click the <strong>table headers</strong> to sort the table accordingly or select a <strong>row</strong> to make changes.</p>
    <br>
    <div class="container">
        <div class="table">
            <table id="tasks_table" class="w3-table-all">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Due</th>
                    <th>Done</th>
                </tr>
                <?php
                $i = 0;
                foreach($tasks as $task) {
                    $taskid = $task['taskid'];
                    $userid = $task['userid'];
                    $importid = $task['importid'];
                    $name = $task['name'];
                    $description = $task['description'];
                    $due = $task['due'];
                    $state = $task['state'];
                    echo "        <input type='hidden' id='task_row_$i' value='{$taskid}'>";
                    echo "        <input type='hidden' id='import_row_$i' value='{$importid}'>";
                    echo '        <tr class="item">';
                    echo '            <td id="name_scroll"><div class="name_scroll">' . $name . '</div></td>';
                    /* desc id added to allow for manipulation of cell height by setting content div max-height */
                    echo '            <td id="desc_scroll"><div class="desc_scroll">' . $description . '</div></td>';
                    echo '            <td>' . date("D j, M, Y, H:i", strtotime($due)) . '</td>';
                    echo "            <td onclick='event.stopPropagation();'>";
                    if ($importid != null) {
                        if ($state == 0) {
                            echo "            <input type='checkbox' class='toggle_state' id='check-{$taskid}' value='{$state}' onclick='event.stopPropagation(); toggleState({$importid}, {$taskid}, {$userid});'>";
                        } else {
                            echo "            <input type='checkbox' class='toggle_state' id='check-{$taskid}' checked value='{$state}' onclick='event.stopPropagation(); toggleState({$importid}, {$taskid}, {$userid});'>";
                        }
                    } else {
                        if ($state == 0) {
                            echo "            <input type='checkbox' class='toggle_state' id='check-{$taskid}' value='{$state}' onclick='event.stopPropagation(); toggleState(null, {$taskid}, {$userid});'>";
                        } else {
                            echo "            <input type='checkbox' class='toggle_state' id='check-{$taskid}' checked value='{$state}' onclick='event.stopPropagation(); toggleState(null, {$taskid}, {$userid});'>";
                        }
                    }
                    echo "            </td>";
                    echo '        </tr>';
                    $i++;
                }
                ?>
            </table>
        </div>
        <div class="edit" id="edit">
            <form name="edit_task" action="inc/edit-task.inc.php" method="post" onsubmit="return confirm('Do you really want to submit the form?');">
                <input type="hidden" name="taskid" id="taskid">
                <strong>Name:</strong><input type="text" name="name" id="name" pattern="[\w\s\S\W].{0,254}" required="required"><br><br>
                <strong>Description:</strong><textarea id="description" name="description" rows="4" cols="80" required="required"></textarea><br><br>
                <strong>Due Date:</strong><input type="date" name="date" id="date" max="9999-12-31"><br><br>
                <strong>Time:</strong><input type="time" name="time" id="time"><br><br>
                <strong>Done:</strong><input type="text" name="state" id="state" pattern="[01].{0}" required="required"><br><br>
                <input type="submit" name="edit_task_btn" id="submit_btn" value="Edit Task">
                <button type='button' name='cancel_btn' id='cancel_btn' onclick='document.getElementById("edit").style.visibility = "hidden";'>Cancel</button>
                <button type='submit' name='delete_btn' id='delete_btn' formaction='inc/delete-task.inc.php'>Delete Task</button>
                <button type='submit' name='export_btn' id='export_btn' formaction='inc/export-task.inc.php'>Export Task</button>
            </form>
        </div>
    </div>
    <a id="back2Top" title="Back to top" href="#">➤</a>
    <script src="../js/scroll-arrow.js"></script>
    <script src="../js/sort-column.js"></script>
    <script src="../js/edit-task.js"></script>
    <script src="../js/validate-txt.js"></script>

<?php
require "footer.php";
?>