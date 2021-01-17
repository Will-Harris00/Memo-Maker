<?php
require_once "header.php";
?>

<main>
<form action="inc/add-task.inc.php" method="post" id="new_task" name="new_task">
    <h3>Add a new task to the list</h3>
    <label> Name
        <input name="name" placeholder="Give it a name. (Max 255 characters.)" required="required" pattern="[\w\s\S\W].{0,254}" size="18" type="text">
    </label>
    <label>Date
        <input name="date" placeholder="When is it due?" required="required" type="text" min="1970-01-01" max="9999-12-31">
    </label>
    <label>Time
        <input name="time" placeholder="At what time?" required="required" type="text" onfocus="(this.type='time')">
    </label>
</form>
    <label for="description">Description</label>
    <textarea form="new_task" id="description" name="description" rows="4" cols="80" placeholder="What is the task about? (Max 65,535 characters.)" required="required"></textarea>
    <button form="new_task" id="submit_btn" name="new_task_btn" type="submit">Add Task</button>
    <script src="../js/validate-txt.js"></script>
    <script src="../js/current-date.js"></script>
</main>

<?php
require_once "footer.php";
?>
