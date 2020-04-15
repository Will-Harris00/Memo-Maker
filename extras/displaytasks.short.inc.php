<?php
session_start();
require "header.php";
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Memo Maker</title>
    <!--<link rel="stylesheet" type='text/css' href="../css/style.php">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">

    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <meta name="Developer" content="680033128">
    <meta name="Description" content="Index page for task management system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=on user-scalable=no">
</head>

<body>
<form action="inc/addtask.inc.php" method="post" id="new_task">
    <h3>Add a new task to the list</h3>
    <label> Name:
        <input required="required" pattern="[a-zA-Z0-9\w\s\p{P}\p{S}].{1,18}" size="18" name="name" placeholder="Give this memo a name.">
    </label>
    <label>Date :
        <input placeholder="When is it due?" name="date" type="text" size="12" required="required" min="1970-01-01" max="9999-12-31" onfocus="(this.type='date')" onblur="(this.type='text')">
    </label>
    <label>Time :
        <input placeholder="At what time?" name="time" type="text" size="8" required="required" onfocus="(this.type='time')" onblur="(this.type='text')">
    </label>
    <input type="submit" name="new_task_btn" value="Add Task">
</form>
<textarea id="description" name="description" rows="4" cols="80" form="new_task" placeholder="Task description..."></textarea>
<br>

<?php
if (!(isset($_SESSION['userid']))) {
    header("Location: ../../index.php");
} else {
    $userid = $_SESSION['userid'];
    echo $userid;
    require "inc/handler.inc.php";
    $sql = "SELECT name, description, due, state 
            FROM Tasks 
            WHERE userid=?";
    echo $userid;
    /*
    $stmt = mysqli_prepare($conn, $sql);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../tasks.php?error=sqltasksrequesterror&userid=" . $userid);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }
    */
    /* bind variable to statement */
    // mysqli_stmt_bind_param($stmt, "i", $userid);
    if ($stmt = mysqli_prepare($conn, $sql)) {
        /* bind variable to statement */
        mysqli_stmt_bind_param($stmt, "i", $userid);
        /* execute statement */
        mysqli_stmt_execute($stmt);
        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $name, $description, $due, $state);
        //if (mysqli_stmt_num_rows($stmt) > 0) {
        echo '<br>';
        echo $userid;
        echo '<table>';
        echo '<tr><th>Name</th><th>Description</th><th>Due</th><th>Completed</th></tr>';
        /* fetch values */
        while (mysqli_stmt_fetch($stmt)) {
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $description . "</td>";
            echo "<td>" . $due . "</td>";
            echo "<td>" . $state . "</td>";
            echo "</tr>";
        }
        echo '</table>';
        //}
        /* close statement */
        mysqli_stmt_close($stmt);
        /* close connection */
        mysqli_close($conn);
        exit();
    }
}
?>

</body>
</html>
