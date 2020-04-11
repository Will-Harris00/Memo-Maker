<?php
session_start();
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

<!-- Navigation bar -->

<ul class="topnav">
    <li><a href="../../index.php">🏠 Home</a></li>
    <li><a href="login.php">🔐 Login</a></li>
</ul>


<!-- Sign up form -->
<main>
    <form action="inc/signup.inc.php" method="post" name="signup_form">
        <label>
            <input type="text" name="username" placeholder="Username" pattern="^[A-Za-z0-9_-]{3,15}$">
        </label>
        <br>
        <label>
            <input type="password" name="password" placeholder="Password">
        </label>
        <br>
        <label>
            <input type="password" name="confirm_password" placeholder="Repeat Password">
        </label>
        <br>
        <input type="submit" name="signup_btn" value="Sign up">
        <span id='message'></span>
    </form>
    <script src="../js/validate.js"></script>
</main>

</body>
</html>