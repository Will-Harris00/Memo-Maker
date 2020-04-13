<?php
require "header.php";
?>

<html lang="en">
<body>
<main>
<form action="inc/addtask.inc.php" method="post" id="new_task">
    <h3>Add a new task to the list</h3>
    <label> Name
        <input name="name" placeholder="Give it a name." required="required" pattern="[a-zA-Z0-9\w\s\p{P}\p{S}].{1,18}" size="18" type="text">
    </label>
    <label>Date
        <input name="date" placeholder="When is it due?" type="text" size="12" required="required" min="1970-01-01" max="9999-12-31" onfocus="(this.type='date')" onblur="(this.type='text')">
    </label>
    <label>Time
        <input name="time" placeholder="At what time?" type="text" size="8" required="required" onfocus="(this.type='time')" onblur="(this.type='text')">
    </label>
</form>
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="4" cols="80" form="new_task" placeholder="What is the task about?"></textarea>
    <button form="new_task" name="new_task_btn" type="submit" value="Add Task">Add Task</button>
</main>
</body>
</html>
