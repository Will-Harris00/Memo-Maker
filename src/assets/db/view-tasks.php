<?php
require "header.php";

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    // echo '<link rel="stylesheet" type=\'text/css\' href="../../css/style.php">';
    // require "handler.inc.php";
    require "../secure/credentials.php";

    $sql = "SELECT name, description, due, state 
            FROM Tasks 
            WHERE userid=?";

    $conn = mysqli_connect(host, user, password, database, port);

    /*
    $stmt = mysqli_prepare($conn, $sql);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add-tasks.php?error=sqltasksrequesterror&userid=" . $userid);
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
        echo '<br><br>';
        echo '<table>';
        echo '<tr><th>Name</th><th>Description</th><th>Due</th><th>Completed</th></tr>';
        /* fetch values */
        while (mysqli_stmt_fetch($stmt)) {
            echo '<tr>';
            echo '<td>' . $name . '</td>';
            echo '<td>' . $description . '</td>';
            echo '<td>' . $due . '</td>';
            echo '<td>' . $state . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        //}
        /* close statement */
        mysqli_stmt_close($stmt);
        /* close connection */
        mysqli_close($conn);
    }
}
?>