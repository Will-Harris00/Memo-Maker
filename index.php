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
    <main>
        <h1>Memo Maker Incorporated by 680033128</h1><br>
        <h2>Welcome to my website.</h2>
        <h3>Sign-up to begin your journey.</h3>
        <br>
        <p>The purpose of this site is to be a platform for users to create and maintain a list of memo's accessible from anywhere in the world, so long as you have WiFi.
            Through this portal users are able to form collaborations by utilising our remote sharing web service to synchronise task sharing in realtime and spread the workload.
            This innovative system records the state of each task and informs the individual users whenever one of their assignments is completed.
            Users can register for this service safe in the knowledge that there personal details are secure by state of the art
            security measures implementing top-level cryptographic algorithms to ensure your information is never compromised.
            This is a site built for the workaholics, the eager beavers, the busy bees. One which will allow you to improve your workflow in both a friendly to use and intuitive way.
        </p>


    </main>

<?php
require_once "assets/db/footer.php";
?>