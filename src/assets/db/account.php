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

<body>
<main>
    <?php
    if (!(isset($_SESSION['userid']))) {
        header("Location: ../../index.php");
    }
    ?>
    <form action = "inc/preferences.inc.php" method = "post">
        <p>
            <label>Background:
                <select name="background">
                    <option value="black">Black</option>
                    <option value="white" selected>White</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                </select>
            </label><br />
            <label>Foreground:
                <select name="foreground">
                    <option value="black" selected>Black</option>
                    <option value="white">White</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                </select>
            </label></p>
        <input type="submit" value="Change Preferences" name="change_preferences">
    </form>
</main>
</body>
</html>
