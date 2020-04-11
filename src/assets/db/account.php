<?php
session_start();
if (!(isset($_SESSION['userid']))) {
    header("Location: ../../index.php");
}
require "header.php";
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Memo Maker</title>
    <!--<link rel="stylesheet" type='text/css' href="../css/style.php">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">

    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <meta name="Developer" content="680033128">
    <meta name="Description" content="Index page for task management system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=on user-scalable=no">
</head>

<body>
<main>
    <form autocomplete="off" action="inc/preferences.inc.php">
        <div class="autocomplete" style="width:300px;">
            <label>Background:
                <input type="text" name="background" placeholder="Background Colour">
            </label>
        </div>
        <div class="autocomplete" style="width:300px;">
            <label>Foreground:
                <input type="text" name="foreground" placeholder="Foreground Colour">
            </label>
        </div>
        <input type="submit" value="Change Preferences" name="change_preferences">
    </form>
    <script src="../js/colours.js"></script>
</main>
</body>
</html>
