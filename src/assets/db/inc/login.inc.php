<?php
session_start();

if (isset($_POST['login_btn'])){
    require "handler.inc.php";
    $user = $_POST["username"];
    $pass = $_POST["password"];

    if (empty($user) || empty($pass)) {
        header("Location: ../login.php?error=emptyfields&user=" . $user);
        mysqli_close($conn);
        exit();
    } else {
        $sql = "SELECT userid, username, password, salt
                FROM Users
                WHERE username=?";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlinserterror&user=" . $user);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $fetch_id, $fetch_user, $fetch_pass, $salt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_fetch($stmt);
                $pepper = "56d211ada15f43c28b49436908d47468e9f7e25b5c89cd28d3880a100e385299";
                if (md5($pass . $salt . $pepper) != $fetch_pass) {
                    header("Location: ../login.php?error=incorrect_password");
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    exit();
                } else {
                    $_SESSION["userId"] = $fetch_id;
                    header("Location: ../tasks.php?login=success");
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    exit();
                }
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
