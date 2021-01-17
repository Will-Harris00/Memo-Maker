<?php
session_start();

if (isset($_POST['signup_btn'])){
    require "handler.inc.php";
    require "../../secure/pepper.php";
    $user = htmlentities($_POST['username']);
    $pass = htmlentities($_POST['password']);
    $passConfirm = htmlentities($_POST['confirm_password']);

    if (empty($user) || empty($pass) || empty($passConfirm)) {
        header("Location: ../sign-up.php?error=emptyfields&user=" . $user);
        mysqli_close($conn);
        exit();
    } else if (!preg_match("/^[A-Za-z0-9_-]{3,15}$/", $user)) {
        header("Location: ../sign-up.php?error=invalidusername");
        mysqli_close($conn);
        exit();
    } else if ($passConfirm != $pass) {
        header("Location: ../sign-up.php?error=passwordcheck&user=" . $user);
        mysqli_close($conn);
        exit();
    } else {
        $sql = "SELECT username
                FROM Users
                WHERE username=?";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../sign-up.php?error=sqluserrequesterror&user=" . $user);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../sign-up.php?error=usertaken");
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                exit();
            } else {
                $sql = "INSERT INTO Users
                        (username, password, salt)
                        VALUES (?, ?, ?)";

                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../sign-up.php?error=sqluserinserterror&user=" . $user);
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    exit();
                } else {
                    $salt = md5(rand());
                    mysqli_stmt_bind_param($stmt, "sss", $user, md5($pass . $salt . PEPPER), $salt);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_close($stmt);

                    $userid = mysqli_insert_id($conn);

                    $sql = "INSERT INTO Preferences
                            (userid) 
                            VALUES (?)";

                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../sign-up.php?error=sqlpreferencesinserterror&user=" . $user);
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "i", $userid);
                        mysqli_stmt_execute($stmt);
                        $_SESSION['userid'] = htmlentities($userid);
                        header("Location: ../add-tasks.php?signup=success");
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        exit();
                    }
                }
            }
        }
    }
} else {
    header("Location: ../sign-up.php");
    mysqli_close($conn);
    exit();
}
