<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Memo Maker</title>
    <link rel="stylesheet" type='text/css' href="assets/css/style.php">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">

    <link rel="shortcut icon" href="assets/imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/imgs/favicon.ico" type="image/x-icon">

    <meta name="Developer" content="680033128">
    <meta name="Description" content="Index page for task management system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=on user-scalable=no">

</head>

<body>
<!-- Navigation bar -->
<nav>
    <ul>
        <!-- The id attribute serves an important role here, the css file gets the data contained in id and ensures
         that space assigned for the link text when it becomes bold on mouseover/hover. This reduces the annoying right
         shift that would otherwise occur. Furthermore my reasoning for not using the title attribute to store this
         data is to stop the annoying text box from appearing whenever a user hovers over a link in the header bar. -->
        <li><a href="index.php" id="🏠 Home">🏠 Home</a></li>
        <li><a href="assets/db/sign-up.php" id="🙋 Sign Up">🙋 Sign Up</a></li>
        <li><a href="assets/db/login.php" id="🔐 Login">🔐 Login</a></li>
        <li><a href="assets/db/inc/logoff.inc.php" id="Logoff 🚪🚶">Logoff 🚪🚶</a></li>
    </ul>
<nav>

<?php
require_once "assets/db/footer.php";
?>