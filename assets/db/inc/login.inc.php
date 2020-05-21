<?php
session_start();

if (isset($_POST['login_btn'])){
    require "handler.inc.php";
    require "../../secure/pepper.php";
    $user = htmlentities($_POST['username']);
    $pass = htmlentities($_POST['password']);

    if (empty($user) || empty($pass)) {
        header("Location: ../login.php?error=emptyfields&user=" . $user);
        mysqli_close($conn);
        exit();
    } else {
        $sql = "SELECT userid, password, salt
                FROM Users
                WHERE username=?";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqluserrequesterror&user=" . $user);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $fetch_id, $fetch_pass, $salt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_fetch($stmt);
                if (md5($pass . $salt . PEPPER) != $fetch_pass) {
                    header("Location: ../login.php?error=incorrect_password");
                } else {
                    $_SESSION['userid'] = htmlentities($fetch_id);
                    header("Location: view-tasks.inc.php?login=success");
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                exit();
            } else {
                header("Location: ../login.php?error=invalid_user");
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                exit();
            }
        }
    }
} else {
    header("Location: ../login.php");
    mysqli_close($conn);
    exit();
}
