<?php
session_start();

if (isset($_POST['new_task_btn'])) {
    $userid = htmlspecialchars($_SESSION['userid']);
    $name = htmlentities($_POST['name']);
    $due =  htmlentities(date('Y-m-d H:i', strtotime(str_replace("/","-",$_POST['date']) . $_POST['time'])));
    $description = htmlentities($_POST['description']);
    require "handler.inc.php";

    if (empty($name) || empty($due) || empty($description)) {
        header("Location: ../add-tasks.php?error=emptyfields&userid=" . $userid);
        mysqli_close($conn);
        exit();
    } else {
        $sql = "INSERT INTO Tasks
                (userid, name, description, due)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../add-tasks.php?error=sqluserinserterror&userid=" . $userid);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "isss", $userid, $name, $description, $due);
            mysqli_stmt_execute($stmt);
            header("Location: ../add-tasks.php?newtask=success");
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        }
    }
}
?>
