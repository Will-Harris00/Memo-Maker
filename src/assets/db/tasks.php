<?php
session_start();
require "header.php";
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

<?php
if (!(isset($_SESSION['userid']))) {
    header("Location: ../../index.php");
}
?>
<body>
<h1>Welcome to Diego's Website</h1>
I am a lecturer at the University of Exeter.
This year I am teaching Web-Development.

</body>
</html>
