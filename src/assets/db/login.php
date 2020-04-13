<?php
session_start();
if (isset($_SESSION['userid'])) {
    header("Location: tasks.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="Developer" content="680033128">
<meta name="Description" content="Index page for task management system">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=on user-scalable=no">
<head>
    <title>Memo Maker</title>
    <link rel="stylesheet" type='text/css' href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
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
        <li><a href="sign-up.php" id="🙋 Sign Up">🙋 Sign Up</a></li>
    </ul>
</nav>

<!-- Login form -->
<main>
    <form action="inc/login.inc.php" method="post" name="login_form">
        <label>
            <input type="text" name="username" placeholder="Username">
        </label>
        <br>
        <label>
            <input type="password" name="password" placeholder="Password">
        </label>
        <br>
        <span id='message'></span>
        <input type="submit" name="login_btn" value="Login">
    </form>
</main>

<?php
require "footer.php";
?>