<?php
require_once "header.php";
?>

<html lang="en">
<body>
<main>
<form action="inc/addtask.inc.php" method="post" id="new_task" name="new_task">
    <h3>Add a new task to the list</h3>
    <label> Name
        <input name="name" placeholder="Give it a name. (Max 255 characters.)" required="required" pattern="[a-zA-Z0-9\w\s\p{P}\p{S}].{0,254}" size="18" type="text">
    </label>
    <label>Date
        <input name="date" placeholder="When is it due?" required="required" type="text" max="9999-12-31" onfocus="(this.type='date')" onblur="(this.type='text')">
    </label>
    <label>Time
        <input name="time" placeholder="At what time?" required="required" type="text" onfocus="(this.type='time')" onblur="(this.type='text')">
    </label>
</form>
    <label for="description">Description</label>
    <textarea form="new_task" id="description" name="description" match="[a-zA-Z0-9\w\s\p{P}\p{S}].{0,2}" placeholder="What is the task about? (Max 65,535 characters.)" required="required" rows="4" cols="80"></textarea>
    <button form="new_task" name="new_task_btn" type="submit" value="Add Task">Add Task</button>
    <script src="../js/valtextarea.js"></script>
</main>

<?php
require_once "footer.php";
?>
