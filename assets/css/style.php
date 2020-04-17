<?php
header('Content-type: text/css; charset=utf-8' );
require "../db/inc/preferences.inc.php";
?>
/*

General styling

*/


html {
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

table, td, th {
    padding:5px;
    border: 1px solid powderblue;
    font-weight: normal;
    text-align: center;
}

.desc_scroll {
    max-height:125px;
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

th {
    color: white;
    cursor: pointer;
    background-color: rgba(29,150,178,1);
    border: 1px solid rgba(29,150,178,1);
}

tr:nth-child(odd) {
    background-color: #ffffff;
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
}

div.table {
    position: static;
    width: 100%:
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
    border: 1px solid transparent;
    background-color: DodgerBlue;
    color: white;
    cursor: pointer;
    padding: 10px;
    width: auto;
}

input[type=password]:focus {
    outline:none;
    border-color:DodgerBlue;
    box-shadow:0 0 10px DodgerBlue;
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

    .name_scroll {
        max-height:150px;
        overflow-x: hidden;
        overflow-y: auto;
        padding-left: 2px;
        padding-right: 2px;
    }

    td#name_scroll {
        /* keeps paragraph formatting and newline breaks */
        white-space: pre-wrap;
        /* allows for splitting of continuous strings with no whitespaces */
        word-wrap: break-word;
        word-break: break-word;
        /*page-break-inside: auto;*/
        overflow-x: hidden;
        overflow-y: auto;
        width: auto;
        max-width: 200px;
    }
}