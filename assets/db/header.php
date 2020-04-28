<?php
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: login.php");
    exit();
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
    <script type="text/javascript" src="../js/change-state.js"></script>
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
        <li><a href="inc/view-tasks.inc.php" id="📄 View Tasks">📄 View Tasks</a></li>
        <li><a href="add-tasks.php" id="📝 Add Tasks">📝 Add Tasks</a></li>
        <li><a href="inc/import-tasks.inc.php" id="📃 Import Tasks">📃 Import Tasks</a></li>
        <li><a href="account.php" id="⚙️ Account">⚙️ Account</a></li>
        <li><a href="inc/switch-user.inc.php" id="👥 Switch User">👥 Switch User</a></li>
        <li><a href="inc/logoff.inc.php" id="Logoff 🚪🏃‍">Logoff 🚪🏃</a></li>
    </ul>
</nav>