<?php
session_start();
$bg = "AliceBlue";
$fg = "PowderBlue";
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
            mysqli_close($conn);
        } else {
            $bg = "AliceBlue";
            $fg = "PowderBlue";
        }
    }
}
?>

/*

General styling

*/


html {
scroll-behavior: smooth;
height: 100%;
margin: 0;
padding: 0;
font-family: 'Roboto', sans-serif;
color: #292929;
}

body {
height: 100%;
margin: 0;
background-repeat: no-repeat;
background-attachment: fixed;
background-position: center;
background-size: cover;
font-size: 1rem;
display: flex;
flex-direction: column;
background-color: <?php echo $bg; ?>;
}

main {
max-width: 800px;
margin: auto;
padding: 0.5rem;
text-align: center;
}

a {
text-decoration: none;
color: Black;
}

a#no_tasks:hover {
text-decoration: underline;
}

table, td, th {
padding:5px;
border: 1px solid PowderBlue;
font-weight: normal;
text-align: center;
}

.desc_scroll {
max-height:175px;
overflow-x: hidden;
overflow-y: auto;
padding-left: 2px;
padding-right: 2px;
}

td#desc_scroll {
padding: 2px;
/* keeps paragraph formatting and newline breaks */
white-space: pre-wrap;
/* allows for splitting of continuous strings with no whitespaces */
word-wrap: break-word;
word-break: break-word;
/*page-break-inside: auto;*/
overflow-x: hidden;
overflow-y: auto;
width: auto;
max-width: 600px;
}

.name_scroll {
max-height:175px;
overflow-x: hidden;
overflow-y: auto;
padding-left: 2px;
padding-right: 2px;
}

td#name_scroll {
padding: 2px;
/* keeps paragraph formatting and newline breaks */
white-space: pre-wrap;
/* allows for splitting of continuous strings with no whitespaces */
word-wrap: break-word;
word-break: break-word;
/*page-break-inside: auto;*/
overflow-x: hidden;
overflow-y: auto;
width: auto;
max-width: 125px;
}

th {
color: white;
cursor: pointer;
background-color: rgba(29,150,178,1);
border: 1px solid rgba(29,150,178,1);
}

tr:nth-child(odd) {
background-color: White;
}

tr:nth-child(even) {
background-color: #f2f2f2;
}

table tr:not(:first-child) {
cursor: pointer;transition: all .25s ease-in-out;
}

table tr:not(:first-child):hover {
background-color: #ddd;
}

table {
border-collapse: collapse;
width:100%;
}

div.container {
position: relative;
width: 100%;
background-color: white;
}

div.table {
position: static;
width: 100%;
top:0;
left:0;
}

div.edit {
background-color: white;
position: absolute;
width:100%;
height: 100%;
top:0;
left:0;
z-index: 1;
visibility: hidden;
box-shadow:0 0 10px DodgerBlue;
}

form[name=edit_task] {
padding:8px 0px 12px 8px;
background-color: white;
}

textarea {
font-family: 'Roboto', sans-serif;
border: 1px solid transparent;
padding: 10px;
font-size: 16px;
background-color: White;
width: 100%;
resize: vertical;
min-height: 150px;
}

input {
border: 1px solid transparent;
background-color: White;
padding: 10px;
font-size: 16px;
width: 100%;
}

input[type=submit], button {
color: white;
cursor: pointer;
padding: 10px;
font-size: 16px;
width: auto;
display: inline;
border: 1px solid transparent;
background-color: DodgerBlue;
}

button[name=cancel_btn] {
border: 1px solid transparent;
background-color: Orange;
}

button[name=delete_btn] {
border: 1px solid transparent;
background-color: Red;
}

button[name=export_btn] {
border: 1px solid transparent;
background-color: Purple;
}

input#import_tasks {
padding: 20px;
font-weight: bold;
font-size: 24px;
width: 100%;
}

input[type=checkbox] {
background-color: transparent;
margin: 0px;
}

/*

Scroll Arrow

*/


#back2Top {
width: 40px;
line-height: 40px;
overflow: hidden;
z-index: 999;
display: none;
cursor: pointer;
-moz-transform: rotate(270deg);
-webkit-transform: rotate(270deg);
-o-transform: rotate(270deg);
-ms-transform: rotate(270deg);
transform: rotate(270deg);
position: fixed;
bottom: 50px;
right: 0;
background-color: #DDD;
color: #555;
text-align: center;
font-size: 30px;
text-decoration: none;
}

#back2Top:hover {
background-color: #DDF;
color: #000;
}

/*

Navigation Bar

*/


nav ul {
font-family: 'Lato', sans-serif;
width: 100%;
padding: 0;
margin: 0;
top: 0;
background-color: <?php echo $fg; ?>;
}

nav ul li, a {
display: inline-block;
text-align: center;
}

nav ul li a::before {
display: block;
content: attr(id);
font-weight: bold;
height: 0;
overflow: hidden;
visibility: hidden;
}

nav ul li a {
display: inline-block;
padding: 20px 15px;
text-align: center;
margin: auto;
text-decoration: none;
color: DarkSlateGray;
}

nav ul li a:hover {
font-weight: bold;
animation: bounce 0.3s;
color: CadetBlue;
}

/*
Future development would all the user to change the colour of nearly every
element on the page but for now I am sticking to only making changes to
background and foreground colours, as such this hover effect is redundant.

nav ul li:hover{
background: Honeydew;
}
*/


/*

Preferences selector

*/


* {
box-sizing: border-box;
padding: 0;
}

/*the container must be positioned relative:*/
.autocomplete {
width: 300px;
position: relative;
display: inline-block;
}

.autocomplete-items {
position: absolute;
border: 1px solid #d4d4d4;
border-bottom: none;
border-top: none;
z-index: 1;
/*position the autocomplete items to be the same width as the container:*/
top: 100%;
left: 0;
right: 0;
}

.autocomplete-items div {
padding: 10px;
cursor: pointer;
background-color: White;
border-bottom: 1px solid #d4d4d4;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
background-color: #e9e9e9;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
background-color: DodgerBlue !important;
color: White;
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
transform: translate(0px, 2px);
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
transform: translate(0px, 2px);
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


/*

Styling for small screens

*/


@media screen and (max-width: 700px) {
nav ul li, a {
display: block;
text-align: center;
}

.desc_scroll {
max-height:168px;
overflow-x: hidden;
overflow-y: auto;
padding-left: 2px;
padding-right: 2px;
}

td#desc_scroll {
padding: 2px;
/* keeps paragraph formatting and newline breaks */
white-space: pre-wrap;
/* allows for splitting of continuous strings with no whitespaces */
word-wrap: break-word;
word-break: break-word;
/*page-break-inside: auto;*/
overflow-x: hidden;
overflow-y: auto;
width: auto;
max-width: 500px;
}

.name_scroll {
max-height:168px;
overflow-x: hidden;
overflow-y: auto;
padding-left: 2px;
padding-right: 2px;
}

td#name_scroll {
padding: 2px;
/* keeps paragraph formatting and newline breaks */
white-space: pre-wrap;
/* allows for splitting of continuous strings with no whitespaces */
word-wrap: break-word;
word-break: break-word;
/*page-break-inside: auto;*/
overflow-x: hidden;
overflow-y: auto;
width: auto;
max-width: 225px;
}
}