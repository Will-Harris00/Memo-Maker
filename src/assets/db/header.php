<?php
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: ../../index.php");
}
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
    <li><a href="account.php">⚙️Account</a></li>
    <li><a href="tasks.php">📝 Tasks</a></li>
    <li><a href="inc/logoff.inc.php">Logoff 🚪🚶</a></li>
</ul>
</body>
</html>