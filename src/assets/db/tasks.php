<?php
require "header.php";
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Memo Maker</title>
    <link rel="stylesheet" type='text/css' href="../css/style.php">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">

    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <meta name="Developer" content="680033128">
    <meta name="Description" content="Index page for task management system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=on user-scalable=no">
</head>

<body>
<main>
<form action="inc/addtask.inc.php" method="post" id="new_task">
    <h3>Add a new task to the list</h3>
    <label> Name:
        <input name="name" placeholder="Give it a name." required="required" pattern="[a-zA-Z0-9\w\s\p{P}\p{S}].{1,18}" size="18" type="text">
    </label>
    <label>Date :
        <input name="date" placeholder="When is it due?" type="text" size="12" required="required" min="1970-01-01" max="9999-12-31" onfocus="(this.type='date')" onblur="(this.type='text')">
    </label>
    <label>Time :
        <input name="time" placeholder="At what time?" type="text" size="8" required="required" onfocus="(this.type='time')" onblur="(this.type='text')">
    </label>
</form>
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="4" cols="80" form="new_task" placeholder="What is the task about?"></textarea>
    <button form="new_task" name="new_task_btn" type="submit" value="Add Task">Add Task</button>
</main>
</body>
</html>
