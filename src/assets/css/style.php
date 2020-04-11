<?php
session_start();
$bg = "#CCE0F5";
$fg = "#028090";
header('Content-type: text/css; charset=utf-8' );
header('Cache-control: must-revalidate');
if (isset($_SESSION['userid'])) {
    require "../secure/credentials.php";
    // require "../db/inc/handler.inc.php";
    $userid = $_SESSION['userid'];

    $sql = "SELECT foreground, background
            FROM Preferences
            WHERE userid=?";

    $conn = mysqli_connect(host, user, password, database, port);

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $userid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $fg, $bg);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            // mysqli_close($conn);
            //exit();
        } else {
            $bg = "#CCE0F5";
            $fg = "#028090";
        }
    }
}
?>

* {
box-sizing: border-box;
}

body {
font: 16px Arial;
}

/*the container must be positioned relative:*/
.autocomplete {
width: 300px;
position: relative;
display: inline-block;
}

input {
border: 1px solid transparent;
background-color: #f1f1f1;
padding: 10px;
font-size: 16px;
}

input[type=text] {
background-color: #f1f1f1;
width: 100%;
}

input[type=submit] {
background-color: DodgerBlue;
color: #fff;
cursor: pointer;
}

.autocomplete-items {
position: absolute;
border: 1px solid #d4d4d4;
border-bottom: none;
border-top: none;
z-index: 99;
/*position the autocomplete items to be the same width as the container:*/
top: 100%;
left: 0;
right: 0;
}

.autocomplete-items div {
padding: 10px;
cursor: pointer;
background-color: #fff;
border-bottom: 1px solid #d4d4d4;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
background-color: #e9e9e9;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
background-color: DodgerBlue !important;
color: #ffffff;
}

html {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Roboto', sans-serif;
    color: #292929;
}

#map {
    height: 40vh;
    width: 100%;
}

body {
    height: 100%;
    margin: 0;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-color: <?php echo $bg; ?>;
;
    /*background-image: linear-gradient(to bottom right, rgba(18, 180, 13, 0.45), #79a9ed);
    */
    background-position: center;
    background-size: cover;
    font-size: 1rem;
    display: flex;
    flex-direction: column;
}

td {
    text-align:center;
}

.content {
    display: flex;
    flex-direction: row;
    align-items: stretch;
    min-height: 500vh;
}

.right {
    flex: 80%;
    float: left;
    height: 100%;
    flex-grow: 2;
    padding: 0px;
    flex-wrap: wrap;
}

.left {
    flex: 20%;
    height: 100%;
    float: left;
    background-color: #00A896;
    padding: 10px;
    text-align: center;
    box-shadow: 0px 5px 10px 0 black;
    z-index: 10;
}

@media screen and (max-width: 700px) {
    .content,

    .topnav {
        flex-direction: column;
    }
    .topnav {
        text-align: center;
        padding: 0px;
    }
}

.explanation {
    display: block;
    width: 100%;
}

.entryData {
    display: block;
    margin: 10px 0px;
}


/*

Navigation Bar

*/

.topnav {
    background-color: <?php echo $fg; ?>;
    margin: 0px;
    z-index: 20;
}

.topnav li {
    display: inline;
}

.topnav li a {
    padding: 20px 15px;
}

a {
    color: inherit;
    text-decoration: none;
}

a.current {
    color: white;
    font-weight: bold;
    /*font-size: 16;*/
}

a:hover {
    font-weight: bold;
    animation: bounce 0.3s;
    color: white;
}

li a {
    display: inline-block;
    padding: 20px 0px;
    color: inherit;
    text-align: center;
    margin: auto;
    text-decoration: none;
    font-family: 'Lato', sans-serif;
}

li a:hover {
    font-weight: bold;
    animation: bounce 0.3s;
}


/*

Animations

*/


/* Safari 4.0 - 8.0 */

@-webkit-keyframes bounce {
    0% {
        transform: translate(0px, 1px);
    }
    20% {
        transform: translate(0px, -2px);
    }
    40% {
        transform: translate(0px, -2px);
    }
    60% {
        transform: translate(0px, -2px);
    }
    80% {
        transform: translate(0px, 2px);
    }
    100% {
        transform: translate(0px, 3px);
    }
}


/* Others */

@keyframes bounce {
    0% {
        transform: translate(0px, 1px);
    }
    20% {
        transform: translate(0px, -2px);
    }
    40% {
        transform: translate(0px, -2px);
    }
    60% {
        transform: translate(0px, -2px);
    }
    80% {
        transform: translate(0px, 2px);
    }
    100% {
        transform: translate(0px, 3px);
    }
}


/* Always set the map height explicitly to define the size of the div
    * element that contains the map. */

#description {
    font-family: 'Roboto';
    font-size: 15px;
    font-weight: 300;
}

#infowindow-content .title {
    font-weight: bold;
}

#infowindow-content {
    display: none;
}

#map #infowindow-content {
    display: inline;
}

.pac-card {
    margin: 10px 10px 0 0;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    background-color: #fff;
    font-family: Roboto;
}

#pac-container {
    padding-bottom: 12px;
    margin-right: 12px;
}

.pac-controls {
    display: inline-block;
    padding: 5px 11px;
}

.pac-controls label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
}

#pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 400px;
}

#pac-input:focus {
    border-color: #4d90fe;
}

#title {
    color: #fff;
    background-color: #4d90fe;
    font-size: 25px;
    font-weight: 500;
    padding: 6px 12px;
}


/* Alternative stuff, unordered so delete if it messes anything up! */

* {
    padding: 0;
}

nav {
    display: grid;
    grid-template-columns: auto 1fr repeat(6, auto);
}

.card {
    margin: 2rem 1em;
    padding: 25px;
    background-color: rgb(93, 202, 179);
    box-shadow: 0 8px 16px 0 #828282;
    border-radius: 4px;
    text-align: center;
}

.card:hover {
    box-shadow: 0 8px 16px 0 #828282;
    background-image: linear-gradient(to bottom right, #e3eded, rgba(162, 79, 255, 0.04));
    color: #0c0c0c;
}

h1 {
    font-family: 'Roboto', serif;
    color: #2e2e2e;
    margin: 5px 20px;
}

main {
    max-width: 800px;
    margin: auto;
    padding: 0.5rem;
    text-align: center;
}

button {
    background-image: linear-gradient(to bottom right, #42e95d, #6767e7);
    height: 30px;
    width: 150px;
    border: 0;
    border-radius: 3px;
    font-size: 1em;
    overflow: hidden;
    color: white;
    letter-spacing: 0.5em;
    font-weight: bold;
    box-shadow: 0 8px 16px 0 #9b9b9b;
}

#myDIV {
    width: 100%;
    padding: 50px 0;
    text-align: center;
    background-color: lightblue;
    margin-top: 20px;
}

.spinner {
    position: fixed;
    left: 50%;
    top: 50%;
    height: 30vh;
    width: 30vh;
    margin-left: -15vh;
    margin-top: -15vh;
    -webkit-animation: rotation .6s infinite linear;
    -moz-animation: rotation .6s infinite linear;
    -o-animation: rotation .6s infinite linear;
    animation: rotation .6s infinite linear;
    border-left: 6px solid rgba(0, 174, 239, .15);
    border-right: 6px solid rgba(0, 174, 239, .15);
    border-bottom: 6px solid rgba(0, 174, 239, .15);
    border-top: 6px solid rgba(0, 174, 239, .8);
    border-radius: 100%;
}

@-webkit-keyframes rotation {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(359deg);
    }
}

@-moz-keyframes rotation {
    from {
        -moz-transform: rotate(0deg);
    }
    to {
        -moz-transform: rotate(359deg);
    }
}

@-o-keyframes rotation {
    from {
        -o-transform: rotate(0deg);
    }
    to {
        -o-transform: rotate(359deg);
    }
}

@keyframes rotation {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(359deg);
    }
}

.overlay {
    background-color: white;
    opacity: 0.5;
    position: fixed;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
}

.number {
    font-size: 40px;
    color: #3e6e2b;
    font-weight: bold;
}

