<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Memo Maker</title>
    <link rel="stylesheet" href="../css/styles.php">
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
    <li><a href="signup.php">🙋 Sign Up</a></li>
</ul>

<!-- Login form -->
<main>
    <form action="inc/login.inc.php" method="post" name="login_form">
        <label>Username
            <input type="text" name="username" placeholder="Username">
        </label>
        <br>
        <label>Password:
            <input type="password" name="password" placeholder="Password">
        </label>
        <br>
        <span id='message'></span>
        <button type="submit" name="login_btn" value="SUBMIT">Login</button>
    </form>
</main>
</body>
</html>

