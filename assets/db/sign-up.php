<?php
session_start();
if (isset($_SESSION['userid'])) {
    header("Location: view-tasks.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="Developer" content="680033128">
    <meta name="Description" content="Index page for task management system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=on user-scalable=no">
    <title>Memo Maker</title>
    <link rel="stylesheet" type='text/css' href="../css/style.php">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
</head>

<body>
<!-- Navigation bar -->
<nav>
    <ul>
        <!-- The id attribute serves an important role here, the css file gets the data contained in id and ensures
         that space assigned for the link text when it becomes bold on mouseover/hover. This reduces the annoying right
         shift that would otherwise occur. Furthermore my reasoning for not using the title attribute to store this
         data is to stop the annoying text box from appearing whenever a user hovers over a link in the header bar. -->
        <li><a href="../../index.php" id="🏠 Home">🏠 Home</a></li>
        <li><a href="login.php" id="🔐 Login">🔐 Login</a></li>
    </ul>
</nav>

<!-- Sign-up form -->
<main>
    <form action="inc/sign-up.inc.php" method="post" name="signup_form">
        <label>
            <input type="text" name="username" placeholder="Username" pattern="^[A-Za-z0-9_-]{3,15}$"
                   oninvalid="this.setCustomValidity('3-15 characters, numbers, letters, underscores and dashes.')"
                   oninput="setCustomValidity('')">
        </label>
        <br>
        <label>
            <input type="password" name="password" placeholder="Password"
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                   oninvalid="this.setCustomValidity('Min 8 characters, at least one uppercase letter, ' +
                    'one lowercase letter, one number and one special character.')" oninput="setCustomValidity('')">
        </label>
        <br>
        <label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat Password">
        </label>
        <br>
        <input type="submit" name="signup_btn" value="Sign up">
    </form>
    <script src="../js/validate-pwd.js"></script>
</main>

<?php
require "footer.php";
?>