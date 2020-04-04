<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Memo Maker</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">

    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <meta name="Developer" content="680033128">
    <meta name="Description" content="Index page for task management system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=on user-scalable=no">
</head>

<body>
<!-- Navigation bar -->
<nav>
    <ul>
        <li><a href="../../index.php">🏠 Home</a></li>
        <li><a href="login.php">🚪🚶 Login</a></li>
    </ul>
</nav>
<label>Username:
    <input name="username" id="username" type="text" />
</label>
<br>
    <label>Password:
        <input name="password" id="password" type="password" />
    </label>
<br>
    <label>Confirm password:
        <input type="password" name="confirm_password" id="confirm_password" />
        <span id='message'></span>
    </label>
</body>
<script  src="../js/validate.js"></script>
</html>